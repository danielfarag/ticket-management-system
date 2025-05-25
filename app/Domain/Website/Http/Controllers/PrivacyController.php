<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class PrivacyController extends BaseController
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * initialize settingRepository
     */
    public function __construct()
    {
        $this->settingRepository = app()->make(SettingRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacy_policy = optional($this->settingRepository->where('key', 'privacy_policy')->first())->value;

        $this->setData('privacy_policy', $privacy_policy);
        $this->addView('Website/Privacy');
        $this->setApiResponse(function() use($privacy_policy){
            return response()->json([
                'privacy_policy' => $privacy_policy,
            ]);
        });

        return $this->response();
    }
}