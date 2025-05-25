<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class TermsController extends BaseController
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
        $terms_conditions = optional($this->settingRepository->where('key', 'terms_conditions')->first())->value;

        $this->setData('terms_conditions', $terms_conditions);
        $this->addView('Website/Terms');
        $this->setApiResponse(function() use($terms_conditions){
            return response()->json([
                'terms_conditions' => $terms_conditions,
            ]);
        });

        return $this->response();
    }
}