<?php

namespace App\Domain\Ticket\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\General\Entities\Comment;
use Illuminate\Support\Facades\Redirect;
use App\Domain\Ticket\Entities\Escalation;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\CommentRepository;
use App\Domain\Ticket\Repositories\Contracts\EscalationRepository;
use App\Domain\Ticket\Http\Resources\Escalation\EscalationResource;
use App\Domain\General\Http\Requests\Comment\CommentStoreFormRequest;
use App\Domain\General\Http\Resources\Comment\CommentResource;
use App\Domain\Ticket\Criteria\Escalation\EscalationSortedByCriteria;
use App\Domain\Ticket\Http\Requests\Escalation\EscalationFormRequest;
use App\Domain\Ticket\Criteria\Escalation\EscalationFiltrationCriteria;
use App\Domain\Ticket\Http\Requests\Escalation\EscalationUpdateFormRequest;
use App\Domain\Ticket\Http\Resources\Escalation\EscalationResourceCollection;

class EscalationController extends BaseController
{
    /**
     * @var EscalationRepository
     */
    private $escalationRepository;

    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     */
    public function __construct()
    {
        $this->escalationRepository = app()->make(EscalationRepository::class);
        $this->ticketRepository = app()->make(TicketRepository::class);
        $this->commentRepository = app()->make(CommentRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->escalationRepository->getModel());
    
        $this->escalationRepository->pushCriteria(EscalationSortedByCriteria::class);
        $this->escalationRepository->pushCriteria(EscalationFiltrationCriteria::class);

        $escalations = $this->escalationRepository->view()->paginate()->withQueryString();

        $this->setData('escalations', $escalations);

        $this->addView('Escalation/EscalationsIndex');

        $this->useCollection(EscalationResourceCollection::class, 'escalations');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Escalation $escalation)
    {
        $this->authorize('view', $escalation);
        
        $escalation->load(['agent', 'ticket', 'comments.user']);

        $this->setData('escalation', $escalation);

        $this->addView('Escalation/EscalationsShow');

        $this->useCollection(EscalationResource::class, 'escalation');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Escalation $escalation = null)
    {
        if($escalation){
            $this->authorize('update', $escalation);
            $escalation->load('ticket');
        }else{
            $this->authorize('create', $this->escalationRepository->getModel());
        }

        // $tickets = $this->ticketRepository->when(auth()->user()->type == 'agent',function($q){
        //     return $q->whereHas('agents', function($q){
        //         $q->where('users.id', auth()->id());
        //     });
        // })->get();

        $this->setData('escalation', $escalation);
        $this->setData('tickets', $this->ticketRepository->all());
        $this->setData('ticket_id', request()->query('ticket_id', null));

        $this->addView('Escalation/EscalationsCreate');

        $this->useCollection(EscalationResource::class, 'escalation');

        return $this->response();
    }

    /**
     * Create New Escalation.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(EscalationFormRequest $request, Escalation $escalation = null)
    {
        $validated = $request->validated();

        if($request instanceof EscalationUpdateFormRequest){
            $escalation->update($validated);
            $message = 'Escalation Updated Successfully';
         }else{
            $escalation = $this->escalationRepository->create($validated);
            $message = 'Escalation Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('escalation', $escalation, 'api');

        $this->useCollection(EscalationResource::class, 'escalation');

        $this->redirectRoute('escalations.show', $escalation->id);

        return $this->response();
    }

    
    /**
     * Create New Escalation.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escalation $escalation)
    {
        $this->authorize('delete', $escalation);

        $this->escalationRepository->remove($escalation);

        $this->setData('escalation', $escalation);

        $this->useCollection(EscalationResource::class, 'escalation');

        $this->redirectRouteWithQueryParams('escalations.index');
        
        return $this->response();
    } 

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function createComment(CommentStoreFormRequest $request, Escalation $escalation)
    {
        $validated = $request->validated();

        $comment = $escalation->comments()->create($validated);
        
        if(!empty($validated['attachments'])){
            foreach ($validated['attachments'] as $attachment) {
                $comment->addMedia($attachment)->toMediaCollection('attachments');
            }
        }

        $this->flashMessage('success', 'Comment Created Successfully.');
        
        $this->setData('comment', $comment);

        $this->useCollection(CommentResource::class, 'comment');

        $this->redirectRouteWithQueryParams('escalations.show', $escalation->id);
        
        return $this->response();

    }

    /**
     * Create Comment.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteComment(Comment $comment)
    {
        $escalation_id = $comment->commentable->id;

        $this->commentRepository->remove($comment);

        $this->setData('comment', $comment);

        $this->useCollection(CommentResource::class, 'comment');

        $this->redirectRouteWithQueryParams('escalations.show',  $escalation_id);
        
        return $this->response();
    }
}