<?php

namespace App\Domain\General\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Cms\Repositories\Contracts\FaqRepository;
use App\Domain\User\Repositories\Contracts\UserRepository;
use App\Domain\Cms\Repositories\Contracts\ArticleRepository;
use App\Domain\General\Repositories\Contracts\TodoRepository;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;
use App\Domain\Ticket\Repositories\Contracts\SurveyRepository;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\Setting\Repositories\Contracts\MemberRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\General\Repositories\Contracts\ServiceRepository;
use App\Domain\Ticket\Repositories\Contracts\DepartmentRepository;
use App\Domain\Ticket\Repositories\Contracts\EscalationRepository;
use App\Domain\Interaction\Repositories\Contracts\ContactRepository;

class DashboardController extends BaseController
{
    /**
     * Define User Repository Instance
     *
     * @var UserRepository
     */
    public $userRepository;

    /**
     * Define Department Repository Instance
     *
     * @var DepartmentRepository
     */
    public $departmentRepository;

    /**
     * Define Article Repository Instance
     *
     * @var ArticleRepository
     */
    public $articleRepository;

    /**
     * Define Faq Repository Instance
     *
     * @var FaqRepository
     */
    public $faqRepository;

    /**
     * Define Escalation Repository Instance
     *
     * @var EscalationRepository
     */
    public $escalationRepository;

    /**
     * Define Service Repository Instance
     *
     * @var ServiceRepository
     */
    public $serviceRepository;

    /**
     * Define Ticket Repository Instance
     *
     * @var TicketRepository
     */
    public $ticketRepository;

    /**
     * Define Status Repository Instance
     *
     * @var StatusRepository
     */
    public $statusRepository;

    /**
     * Define Todo Repository Instance
     *
     * @var TodoRepository
     */
    public $todoRepository;

    /**
     * Define Survey Repository Instance
     *
     * @var SurveyRepository
     */
    public $surveyRepository;

    /**
     * Define Contact Repository Instance
     *
     * @var ContactRepository
     */
    public $contactRepository;

    /**
     * Define Member Repository Instance
     *
     * @var MemberRepository
     */
    public $memberRepository;

    /**
     * initialize repositories
     */
    public function __construct()
    {
        $this->userRepository = app()->make(UserRepository::class);
        $this->departmentRepository = app()->make(DepartmentRepository::class);
        $this->articleRepository = app()->make(ArticleRepository::class);
        $this->faqRepository = app()->make(FaqRepository::class);
        $this->escalationRepository = app()->make(EscalationRepository::class);
        $this->serviceRepository = app()->make(ServiceRepository::class);
        $this->ticketRepository = app()->make(TicketRepository::class);
        $this->statusRepository = app()->make(StatusRepository::class);
        $this->todoRepository = app()->make(TodoRepository::class);
        $this->surveyRepository = app()->make(SurveyRepository::class);
        $this->contactRepository = app()->make(ContactRepository::class);
        $this->memberRepository = app()->make(MemberRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->selectRaw("count(*) sum, status")->where('type','user')->groupBy('status')->pluck('sum', 'status');
        $agents = $this->userRepository->selectRaw("count(*) sum, status")->where('type','agent')->groupBy('status')->pluck('sum', 'status');
        $departments = $this->departmentRepository->selectRaw("count(*) sum, status")->groupBy('status')->pluck('sum', 'status');
        $articles = $this->articleRepository->selectRaw("count(*) sum, status")->groupBy('status')->pluck('sum', 'status');
        $faqs = $this->faqRepository->selectRaw("count(*) sum, status")->groupBy('status')->pluck('sum', 'status');
        $escalations = $this->escalationRepository->selectRaw("count(*) sum, status")->groupBy('status')->pluck('sum', 'status');
        $services = $this->serviceRepository->selectRaw("count(*) sum, status")->groupBy('status')->pluck('sum', 'status');
        $tickets = $this->ticketRepository->selectRaw("count(*) sum, solved")->groupBy('solved')->pluck('sum', 'solved');
        $ticket_by_statuses = $this->statusRepository->withCount('tickets')->pluck('tickets_count', 'name');
        $survey_by_statuses = $this->surveyRepository->selectRaw("count(*) sum, resolved")->groupBy('resolved')->pluck('sum', 'resolved');

        $todos = $this->todoRepository->selectRaw("count(*) sum, status")->groupBy('status')->pluck('sum', 'status');
        $surveys = $this->surveyRepository->count();
        $contacts = $this->contactRepository->count();
        $members = $this->memberRepository->count();

        $this->setData('users', $this->fillEmpty($users) );
        $this->setData('agents', $this->fillEmpty($agents) );
        $this->setData('departments', $this->fillEmpty($departments) );
        $this->setData('articles', $this->fillEmpty($articles) );
        $this->setData('faqs', $this->fillEmpty($faqs) );
        $this->setData('escalations', $this->fillEmpty($escalations, ['pending', 'in_progress', 'solved']) );
        $this->setData('services', $this->fillEmpty($services) );
        $this->setData('tickets', $this->fillEmpty($tickets, ['yes', 'no']) );
        $this->setData('survey_by_statuses', $this->fillEmpty($survey_by_statuses, ['yes', 'no']) );
        $this->setData('ticket_by_statuses', $ticket_by_statuses );
        $this->setData('todos', $this->fillEmpty($todos, ['done', 'idle', 'todo', 'in_progress', 'urget']) );
        $this->setData('surveys', $surveys );
        $this->setData('contacts', $contacts );
        $this->setData('members', $members );

        $this->addView('Dashboard');

        $this->setApiResponse(function() use($users, $agents, $departments, $articles, $faqs, $escalations, $services, $tickets, $todos, $ticket_by_statuses, $survey_by_statuses, $surveys, $contacts, $members){
            return response()->json([
                'users' => $this->fillEmpty($users),
                'agents' => $this->fillEmpty($agents),
                'departments' => $this->fillEmpty($departments),
                'articles' => $this->fillEmpty($articles),
                'faqs' => $this->fillEmpty($faqs),
                'escalations' => $this->fillEmpty($escalations, ['pending', 'in_progress', 'solved']),
                'services' => $this->fillEmpty($services),
                'tickets' => $this->fillEmpty($tickets, ['yes', 'no']),
                'ticket_by_statuses' => $ticket_by_statuses,
                'survey_by_statuses' => $survey_by_statuses,
                'todos' => $this->fillEmpty($todos, ['done', 'idle', 'todo', 'in_progress', 'urget']),
                'surveys' => $surveys,
                'contacts' => $contacts,
                'members' => $members,
            ]);
        });

        return $this->response();
    }


    /**
     * Fill Empty Colleciton
     *
     * @return void
     */
    private function fillEmpty($collection, $keys = ["active", "inactive"]){
        $empty = collect(array_fill_keys($keys, 0));

        return $empty->merge($collection);
    }
}