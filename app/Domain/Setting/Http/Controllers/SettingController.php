<?php

namespace App\Domain\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use App\Domain\Setting\Http\Requests\Setting\SettingStoreFormRequest;
use App\Domain\Setting\Http\Resources\Setting\SettingResource;
use App\Domain\Ticket\Repositories\Contracts\SeverityRepository;
use App\Domain\Ticket\Repositories\Contracts\StatusRepository;

class SettingController extends BaseController
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * @var SeverityRepository
     */
    private $severityRepository;

    /**
     */
    public function __construct()
    {
        $this->settingRepository = app()->make(SettingRepository::class);
        $this->statusRepository = app()->make(StatusRepository::class);
        $this->severityRepository = app()->make(SeverityRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->settingRepository->getModel());
       
        $settings = $this->settingRepository->getData();
        $statuses = $this->statusRepository->all();
        $severities = $this->severityRepository->all();

        $this->setData('settings', $settings);
        $this->setData('statuses', $statuses->toArray());
        $this->setData('severities', $severities->toArray());

        $this->addView('Setting/Setting');

        $this->setApiResponse(function() use($settings, $statuses, $severities){
            return response()->json([
                'settings'=>$settings,
                'statuses'=>$statuses->toArray(),
                'severities'=>$severities->toArray(),
            ]);
        });

        return $this->response();
    }

    /**
     * Create New Setting.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(SettingStoreFormRequest $request)
    {
        $validated = $request->validated();

        $setting = $this->settingRepository->store($validated);

        $this->flashMessage('success', 'Setting Updated Successfully');

        $this->setData('setting', $setting, 'api');

        $this->useCollection(SettingResource::class, 'setting');

        $this->redirectRoute('settings.index');

        return $this->response();
    }
}