<?php

namespace App\Domain\Website\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\General\Entities\Comment;
use Illuminate\Support\Facades\Redirect;
use App\Domain\Ticket\Criteria\Ticket\TicketSortedByCriteria;
use App\Domain\Ticket\Http\Requests\Ticket\TicketFormRequest;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\Ticket\Criteria\Ticket\TicketFiltrationCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CommentRepository;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\Ticket\Http\Requests\Ticket\TicketUpdateFormRequest;
use App\Domain\General\Http\Requests\Comment\CommentStoreFormRequest;
use App\Domain\General\Http\Resources\Comment\CommentResource;
use App\Domain\Ticket\Events\TicketCreatedEvent;
use App\Domain\Ticket\Http\Resources\Survey\SurveyResource;
use App\Domain\Ticket\Http\Resources\Ticket\TicketResource;
use App\Domain\Ticket\Http\Resources\Ticket\TicketResourceCollection;
use App\Domain\Website\Http\Requests\Ticket\TicketSurveyStoreFormRequest;

class TicketController extends BaseController
{
    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * @var SeverityRepository
     */
    private $severityRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     */
    public function __construct()
    {
        $this->ticketRepository = app()->make(TicketRepository::class);
        $this->categoryRepository = app()->make(CategoryRepository::class);
        $this->statusRepository = app()->make(StatusRepository::class);
        $this->severityRepository = app()->make(SeverityRepository::class);
        $this->commentRepository = app()->make(CommentRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->ticketRepository->pushCriteria(TicketSortedByCriteria::class);
        $this->ticketRepository->pushCriteria(TicketFiltrationCriteria::class);

        $tickets = $this->ticketRepository->view()->where('user_id',auth()->id())->paginate()->withQueryString();

        $categories = $this->categoryRepository->where('type','tickets')->get()->keyBy('name')->keys();
        $statuses = $this->statusRepository->get()->keyBy('name')->keys();
        $severities = $this->severityRepository->get()->keyBy('name')->keys();

        $this->setData('tickets', $tickets);
        $this->setData('categories', $categories);
        $this->setData('statuses', $statuses);
        $this->setData('severities', $severities);

        $this->useCollection(TicketResourceCollection::class, 'tickets');

        $this->addView('Website/Tickets/TicketsIndex');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->load(['notes.agent', 'comments.user', 'user', 'status', 'severity', 'escalation.agent']);

        $this->setData('ticket', $ticket);

        $this->addView('Website/Tickets/TicketsShow');

        $this->useCollection(TicketResource::class, 'ticket');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Ticket $ticket = null)
    {
        if($ticket){
            $this->authorize('update', $ticket);
            $ticket->load(['status', 'severity', 'status', 'user']);
        }else{
            $this->authorize('create', $this->ticketRepository->getModel());
        }
    
        $categories = $this->categoryRepository->where('type', 'tickets')->get();
        $severities = $this->severityRepository->where('status', 'active')->get();
        $statuses = $this->statusRepository->where('status', 'active')->get();

        $this->setData('ticket', $ticket);
        $this->setData('categories', $categories);
        $this->setData('severities', $severities);
        $this->setData('statuses', $statuses);

        $this->addView('Website/Tickets/TicketsCreate');

        $this->useCollection(TicketResource::class, 'ticket');

        return $this->response();

    }

    /**
     * Create New Ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(TicketFormRequest $request,Ticket $ticket = null)
    {
        $validated = $request->validated();

        if($request instanceof TicketUpdateFormRequest){
            $ticket->update($validated);
            $message = 'Ticket Updated Successfully';
         }else{
            $ticket = $this->ticketRepository->create($validated);
            $message = 'Ticket Created Successfully';
        }

        $ticket->categories()->detach();
        $ticket->categories()->attach($validated['category_id']);

        event(new TicketCreatedEvent(auth()->user(), $ticket));
        
        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $file) {
                $ticket->addMedia($file)->toMediaCollection('attachments'); 
            }
        }

        $this->flashMessage('success', $message);

        $this->setData('ticket', $ticket, 'api');

        $this->useCollection(TicketResource::class, 'ticket');

        $this->redirectRoute('website.tickets.show', $ticket->id);

        return $this->response();
    }

    
    /**
     * Create New Ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->categories()->detach();

        $this->ticketRepository->remove($ticket);

        $this->setData('ticket', $ticket);

        $this->useCollection(TicketResource::class, 'ticket');

        $this->redirectRouteWithQueryParams('website.tickets.index');
        
        return $this->response();
    } 
    
    
    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function createComment(CommentStoreFormRequest $request, Ticket $ticket)
    {
        $validated = $request->validated();

        $comment = $ticket->comments()->create($validated);

        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $attachment) {
                $comment->addMedia($attachment)->toMediaCollection('attachments');
            }
        }

        session()->flash('message', ['type'=>'success', 'message'=> 'Comment Created Successfully.']);
      
        return Redirect::route('website.tickets.show', $ticket->id);

    }

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteComment(Comment $comment)
    {
        $ticket_id = $comment->commentable->id;

        $this->commentRepository->remove($comment);

        $this->setData('comment', $comment);

        $this->useCollection(CommentResource::class, 'comment');

        $this->redirectRouteWithQueryParams('website.tickets.show', ['ticket'=>$ticket_id]);
       
        return $this->response();
    }

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSurvey(Ticket $ticket)
    {
        if($ticket->survey){
            $this->redirectRouteWithQueryParams('website.tickets.show', $ticket->id);
            $this->setApiResponse(function(){
                return response()->json(['survey'=>false]);
            });
            return $this->response();
        }

        $this->authorize('survey', $ticket);

        $this->setData('ticket', $ticket);

        $this->useCollection(TicketResource::class, 'ticket');

        $this->addView('Website/Tickets/TicketsSurvey');

        return $this->response();
    }
    
    /**
     * Rate Ticket.
     *
     * @param Request $request
     * @param [type] $id
     * @return \Illuminate\Http\Response
     */
    public function rateTicket(TicketSurveyStoreFormRequest $request, Ticket $ticket)
    {
        $this->authorize('survey', $ticket);
        
        $data = $request->validated();

        $survey = $ticket->survey()->create($data);

        if($data['resolved'] == 'no'){
            [$type, $message] = ['info', 'Thank you for your review and we are sorry for your inconvenice. We will work on increasing our performance'];
        }else{
            [$type, $message] = ['success', 'Thank you for your review and we are happy to meet your expectation'];
        }

        $this->flashMessage($type, $message);

        $this->setData('survey', $survey);

        $this->redirectRouteWithQueryParams('website.tickets.show', $ticket->id);

        $this->useCollection(SurveyResource::class, 'survey');

        return $this->response();
    }

}