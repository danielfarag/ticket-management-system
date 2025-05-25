<?php
namespace App\Domain\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Setting\Entities\Member;
use App\Domain\Setting\Http\Resources\Member\MemberResource;
use App\Domain\Setting\Criteria\Member\MemberSortedByCriteria;
use App\Domain\Setting\Http\Requests\Member\MemberFormRequest;
use App\Domain\Setting\Repositories\Contracts\MemberRepository;
use App\Infrastructure\Http\AbstractControllers\BaseController;
use App\Domain\Setting\Criteria\Member\MemberFiltrationCriteria;
use App\Domain\Setting\Http\Requests\Member\MemberUpdateFormRequest;
use App\Domain\Setting\Http\Resources\Member\MemberResourceCollection;

class MemberController extends BaseController
{
    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
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
    public function index(Request $request)
    {
        $this->authorize('viewAny', $this->memberRepository->getModel());
      
        $this->memberRepository->pushCriteria(MemberSortedByCriteria::class);
        $this->memberRepository->pushCriteria(MemberFiltrationCriteria::class);

        $members = $this->memberRepository->paginate()->withQueryString();

        $this->setData('members', $members);

        $this->addView('Member/MemberIndex');

        $this->useCollection(MemberResourceCollection::class, 'members');

        return $this->response();

    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function show(Member $member)
    {
        $this->authorize('view', $member);

        $this->setData('member', $member);

        $this->addView('Member/MemberShow');

        $this->useCollection(MemberResource::class, 'member');

        return $this->response();
    }

    /**
     * Fill Class Property
     *
     * @return void
     */
    public function createOrEdit(Member $member = null)
    {
        if($member){
            $this->authorize('update', $member);
        }else{
            $this->authorize('create', $this->memberRepository->getModel());
        }

        $this->setData('member', $member);

        $this->addView('Member/MemberCreate');

        $this->useCollection(MemberResource::class, 'member');

        return $this->response();
    }

    /**
     * Create New Member.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(MemberFormRequest $request, Member $member = null)
    {
        $validated = $request->validated();

        if($request instanceof MemberUpdateFormRequest){
            $member->update($validated);
            if(!empty($validated['image'])){
                $member->clearMediaCollection('image');
                $member->addMedia($validated['image'])->toMediaCollection('image');
            }
            $message = 'Member Updated Successfully';
         }else{
            $member = $this->memberRepository->create($validated);
            $member->addMedia($validated['image'])->toMediaCollection('image');
            $message = 'Member Created Successfully';
        }
        
        $this->flashMessage('success', $message);

        $this->setData('member', $member, 'api');

        $this->useCollection(MemberResource::class, 'member');

        $this->redirectRoute('members.show', $member->id);

        return $this->response();
    }

    
    /**
     * Create New Member.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $this->authorize('delete', $member);

        $this->memberRepository->remove($member);

        $this->setData('member', $member);

        $this->useCollection(MemberResource::class, 'member');

        $this->redirectRouteWithQueryParams('members.index');
        
        return $this->response();
    }

}