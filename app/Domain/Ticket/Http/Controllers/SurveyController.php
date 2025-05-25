<?php

namespace App\Domain\Ticket\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Ticket\Entities\Survey;
use App\Domain\Ticket\Criteria\Survey\SurveySortedByCriteria;
use App\Domain\Ticket\Repositories\Contracts\SurveyRepository;
use App\Domain\Ticket\Criteria\Survey\SurveyFiltrationCriteria;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Ticket\Http\Resources\Survey\SurveyResource;
use App\Domain\Ticket\Http\Resources\Survey\SurveyResourceCollection;

class SurveyController extends BaseController
{
    /**
     * @var SurveyRepository
     */
    private $surveyRepository;

    /**
     */
    public function __construct()
    {
        $this->surveyRepository = app()->make(SurveyRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->surveyRepository->getModel());
        
        $this->surveyRepository->pushCriteria(SurveySortedByCriteria::class);
        $this->surveyRepository->pushCriteria(SurveyFiltrationCriteria::class);

        $surveys = $this->surveyRepository->view()->paginate()->withQueryString();

        $this->setData('surveys', $surveys);

        $this->addView('Survey/SurveysIndex');

        $this->useCollection(SurveyResourceCollection::class, 'surveys');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Survey $survey)
    {
        $this->authorize('view', $survey);
        
        $survey->load('ticket');
        
        $this->setData('survey', $survey);

        $this->addView('Survey/SurveysShow');

        $this->useCollection(SurveyResource::class, 'survey');

        return $this->response();
    }

    
    /**
     * Create New Survey.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        $this->authorize('delete', $survey);

        $this->surveyRepository->remove($survey);

        $this->setData('survey', $survey);

        $this->useCollection(SurveyResource::class, 'survey');

        $this->redirectRouteWithQueryParams('surveys.index');
        
        return $this->response();
    }

}