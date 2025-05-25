<?php

namespace App\Domain\Interaction\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Interaction\Entities\Announcement;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Interaction\Repositories\Contracts\AnnouncementRepository;
use App\Domain\Interaction\Http\Resources\Announcement\AnnouncementResource;
use App\Domain\Interaction\Criteria\Announcement\AnnouncementSortedByCriteria;
use App\Domain\Interaction\Http\Requests\Announcement\AnnouncementFormRequest;
use App\Domain\Interaction\Criteria\Announcement\AnnouncementFiltrationCriteria;
use App\Domain\Interaction\Http\Requests\Announcement\AnnouncementUpdateFormRequest;
use App\Domain\Interaction\Http\Resources\Announcement\AnnouncementResourceCollection;

class AnnouncementController extends BaseController
{
    /**
     * @var AnnouncementRepository
     */
    private $announcementRepository;

    /**
     */
    public function __construct()
    {
        $this->announcementRepository = app()->make(AnnouncementRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->announcementRepository->getModel());
      
        $this->announcementRepository->pushCriteria(AnnouncementSortedByCriteria::class);
        $this->announcementRepository->pushCriteria(AnnouncementFiltrationCriteria::class);

        $announcements = $this->announcementRepository->paginate()->withQueryString();

        $this->setData('announcements', $announcements);

        $this->addView('Announcement/AnnouncementsIndex');

        $this->useCollection(AnnouncementResourceCollection::class, 'announcements');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Announcement $announcement)
    {
        $this->authorize('view', $announcement);

        $this->setData('announcement', $announcement);

        $this->addView('Announcement/AnnouncementsShow');

        $this->useCollection(AnnouncementResource::class, 'announcement');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Announcement $announcement = null)
    {
        if($announcement){
            $this->authorize('update', $announcement);
        }else{
            $this->authorize('create', $this->announcementRepository->getModel());
        }

        $this->setData('announcement', $announcement);

        $this->addView('Announcement/AnnouncementsCreate');

        $this->useCollection(AnnouncementResource::class, 'announcement');

        return $this->response();
    }

    /**
     * Create New Announcement.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(AnnouncementFormRequest $request, Announcement $announcement = null)
    {
        $validated = $request->validated();

        if($request instanceof AnnouncementUpdateFormRequest){
            $announcement->update($validated);
            $message = 'Announcement Updated Successfully';
         }else{
            $announcement = $this->announcementRepository->create($validated);
            $message = 'Announcement Created Successfully';
        }

        $this->flashMessage('success', $message);

        $this->setData('announcement', $announcement, 'api');

        $this->useCollection(AnnouncementResource::class, 'announcement');

        $this->redirectRoute('announcements.show', $announcement->id);

        return $this->response();
    }

    
    /**
     * Create New Announcement.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('delete', $announcement);

        $this->announcementRepository->remove($announcement);

        $this->setData('announcement', $announcement);

        $this->useCollection(AnnouncementResource::class, 'announcement');

        $this->redirectRouteWithQueryParams('announcements.index');
        
        return $this->response();
    } 
}