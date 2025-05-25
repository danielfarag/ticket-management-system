<?php

namespace App\Domain\Website\Http\Controllers;

use App\Domain\Setting\Http\Resources\Member\MemberResourceCollection;
use App\Domain\Setting\Repositories\Contracts\MemberRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class TeamMembersController extends BaseController
{
    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * initialize memberRepository
     */
    public function __construct()
    {
        $this->memberRepository = app()->make(MemberRepository::class);
    }

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = $this->memberRepository->all();

        $this->setData('team_members', $team_members);
        $this->addView('Website/TeamMembers');
        $this->useCollection(MemberResourceCollection::class,'team_members');

        return $this->response();

    }
}