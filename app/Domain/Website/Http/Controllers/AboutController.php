<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class AboutController extends BaseController
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
        $about = optional($this->settingRepository->where('key', 'about')->first())->value;

        $this->setData('about', $about);

        $this->setApiResponse(function() use($about){
            return response()->json([
                'about' => $about
            ]);
        });

        $this->addView('Website/About');

        return $this->response();
    }
}