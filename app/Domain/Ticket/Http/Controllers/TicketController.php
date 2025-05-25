<?php

namespace App\Domain\Ticket\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Ticket\Entities\Note;
use Illuminate\Support\Facades\Mail;
use App\Domain\Ticket\Entities\Ticket;
use App\Domain\Ticket\Mail\SurveyMail;
use App\Domain\General\Entities\Comment;
use App\Domain\Ticket\Events\TicketCreatedEvent;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\Ticket\Http\Resources\Ticket\TicketResource;
use App\Domain\Ticket\Repositories\Contracts\NoteRepository;
use App\Domain\Ticket\Criteria\Ticket\TicketSortedByCriteria;
use App\Domain\Ticket\Http\Requests\Ticket\TicketFormRequest;
use App\Domain\Ticket\Http\Requests\Note\NoteStoreFormRequest;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\Ticket\Criteria\Ticket\TicketFiltrationCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CommentRepository;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;
use App\Domain\General\Repositories\Contracts\CategoryRepository;
use App\Domain\Ticket\Http\Requests\Ticket\TicketUpdateFormRequest;
use App\Domain\General\Http\Requests\Comment\CommentStoreFormRequest;
use App\Domain\General\Http\Resources\Category\CategoryResource;
use App\Domain\General\Http\Resources\Comment\CommentResource;
use App\Domain\Ticket\Http\Resources\Ticket\TicketResourceCollection;
use App\Domain\Ticket\Http\Requests\Ticket\TicketUpdateColumnFormRequest;
use App\Domain\Ticket\Http\Resources\Note\NoteResource;
use App\Domain\User\Http\Resources\User\UserResourceCollection;

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
     * @var UserRepository
     */
    private $userRepository;

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
     * @var NoteRepository
     */
    private $noteRepository;

    /**
     */
    public function __construct()
    {
        $this->ticketRepository = app()->make(TicketRepository::class);
        $this->categoryRepository = app()->make(CategoryRepository::class);
        $this->userRepository = app()->make(UserRepository::class);
        $this->statusRepository = app()->make(StatusRepository::class);
        $this->severityRepository = app()->make(SeverityRepository::class);
        $this->commentRepository = app()->make(CommentRepository::class);
        $this->noteRepository = app()->make(NoteRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->ticketRepository->getModel());
      
        $this->ticketRepository->pushCriteria(TicketSortedByCriteria::class);
        $this->ticketRepository->pushCriteria(TicketFiltrationCriteria::class);

        $tickets = $this->ticketRepository->view()->paginate()->withQueryString();

        // For Datatble Filtration
        $categories = $this->categoryRepository->where('type','tickets')->get()->keyBy('name')->keys();
        $statuses = $this->statusRepository->get()->keyBy('name')->keys();
        $severities = $this->severityRepository->get()->keyBy('name')->keys();

        $this->setData('tickets', $tickets);
        $this->setData('categories', $categories);
        $this->setData('statuses', $statuses);
        $this->setData('severities', $severities);

        $this->addView('Ticket/TicketsIndex');

        $this->useCollection(TicketResourceCollection::class, 'tickets');

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
     
        $ticket->load([
            'agents',
            'notes.agent',
            'comments.user',
            'user',
            'status',
            'severity',
            'escalation.agent',
            'survey',
        ]);
        
        $categories = $this->categoryRepository->where('type', 'tickets')->get();
        $severities = $this->severityRepository->where('status', 'active')->get();
        $statuses = $this->statusRepository->where('status', 'active')->get();
        $agents = $this->userRepository->where('type', 'agent')->get();
        
        $this->setData('ticket', $ticket);
        $this->setData('categories', $categories);
        $this->setData('severities', $severities);
        $this->setData('statuses', $statuses);
        $this->setData('agents', $agents);

        $this->addView('Ticket/TicketsShow');

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
        $users = $this->userRepository->where(['status'=> 'active', 'type'=>'user'])->get();

        $this->setData('ticket', $ticket);
        $this->setData('categories', $categories);
        $this->setData('severities', $severities);
        $this->setData('statuses', $statuses);
        $this->setData('users', $users);

        $this->addView('Ticket/TicketsCreate');

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

        if(!empty($validated['attachments'])){
            $ticket->clearMediaCollection('attachments');
            foreach ($validated['attachments'] as $attachment) {
                $ticket->addMedia($attachment)->toMediaCollection('attachments');
            }
        }

        $ticket->categories()->detach();
        $ticket->categories()->attach($validated['category_id']);

        event(new TicketCreatedEvent(auth()->user(), $ticket));

        $this->flashMessage('success', $message);

        $this->setData('ticket', $ticket, 'api');

        $this->useCollection(TicketResource::class, 'ticket');

        $this->redirectRoute('tickets.show', $ticket->id);

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

        $this->flashMessage('success', 'Ticket Deleted Successfully');

        $this->setData('ticket', $ticket);

        $this->useCollection(TicketResource::class, 'ticket');

        $this->redirectRouteWithQueryParams('tickets.index');
        
        return $this->response();
    } 
    
    
    /**
     * Create Note.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNote(NoteStoreFormRequest $request, Ticket $ticket)
    {
        $note = $ticket->notes()->create($request->validated());

        $this->flashMessage('success', 'Note Created Successfully');

        $this->setData('note', $note);

        $this->useCollection(NoteResource::class, 'note');

        $this->redirectRouteWithQueryParams('tickets.show', $ticket->id);

        return $this->response();
    }

    /**
     * Create Note.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteNote(Note $note)
    {
        $this->noteRepository->remove($note);

        $this->flashMessage('success', 'Note Deleted Successfully');

        $this->setData('note', $note);

        $this->useCollection(NoteResource::class, 'note');

        $this->redirectRouteWithQueryParams('tickets.show', ['ticket'=>$note->ticket_id]);

        return $this->response();
    }

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function createComment(CommentStoreFormRequest $request,Ticket $ticket)
    {
        $validated = $request->validated();

        $comment = $ticket->comments()->create($validated);

        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $attachment) {
                $comment->addMedia($attachment)->toMediaCollection('attachments');
            }
        }

        
        $this->flashMessage('success', 'Comment Created Successfully.');

        $this->setData('comment', $comment);

        $this->useCollection(CommentResource::class, 'comment');

        $this->redirectRouteWithQueryParams('tickets.show', $ticket->id);

        return $this->response();
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

        $this->redirectRouteWithQueryParams('tickets.show', $ticket_id);
        
        return $this->response();
    }

    /**
     * Send Survey To User.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSurvey(Request $request, Ticket $ticket)
    {
        $ticket->load('user');

        Mail::to($ticket->user)->queue(new SurveyMail($ticket));

        $this->flashMessage('success', 'Survey Sent Successfully.');

        $this->setData('ticket', $ticket);

        $this->useCollection(TicketResource::class, 'ticket');

        $this->redirectRouteWithQueryParams('tickets.show', $ticket->id);
        
        return $this->response();

    }

    /**
     * Update Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(TicketUpdateColumnFormRequest $request, Ticket $ticket)
    {
        $ticket->categories()->detach();

        $category = $ticket->categories()->attach($request->validated()['category_id']);

        $this->flashMessage('success', 'Category Updated Successfully.');
      
        $this->setData('category', $category);

        $this->useCollection(CategoryResource::class, 'category');

        $this->redirectRouteWithQueryParams('tickets.show', $ticket->id);
        
        return $this->response();
    }

    /**
     * Update Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateColumn(TicketUpdateColumnFormRequest $request, Ticket $ticket, $column  = 'All')
    {
        $data = $request->validated();

        $ticket->update($data);

        $this->flashMessage('success', "$column Updated Successfully.");

        $this->setData('ticket', $ticket);

        $this->useCollection(TicketResource::class, 'ticket');

        $this->redirectRouteWithQueryParams('tickets.show', $ticket->id);
        
        return $this->response();

    }

    
    /**
     * Update Agents.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAgents(TicketUpdateColumnFormRequest $request, Ticket $ticket)
    {
        $data = $request->validated();

        $ticket->agents()->sync($data['agents']);

        $this->flashMessage('success', "Agents Assigned Successfully.");

        $this->setData('agents', $ticket->agents);

        $this->useCollection(UserResourceCollection::class, 'agents');
      
        $this->redirectRouteWithQueryParams('tickets.show', $ticket->id);
        
        return $this->response();
    }
    
}