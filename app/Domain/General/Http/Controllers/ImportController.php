<?php

namespace App\Domain\General\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Domain\Cms\Imports\FaqImport;
use App\Domain\User\Imports\RoleImport;
use App\Domain\User\Imports\UserImport;
use Illuminate\Support\Facades\Redirect;
use App\Domain\Cms\Imports\ArticleImport;
use App\Domain\Ticket\Imports\NoteImport;
use App\Domain\Ticket\Imports\StatusImport;
use App\Domain\Ticket\Imports\SurveyImport;
use App\Domain\Ticket\Imports\TicketImport;
use App\Domain\General\Imports\SliderImport;
use App\Domain\General\Imports\ServiceImport;
use App\Domain\Setting\Imports\BlockIpImport;
use App\Domain\Setting\Imports\SettingImport;
use App\Domain\Ticket\Imports\SeverityImport;
use App\Domain\General\Imports\CategoryImport;
use App\Domain\Interaction\Imports\MailImport;
use App\Domain\Setting\Imports\QuickLinkImport;
use App\Domain\Ticket\Imports\DepartmentImport;
use App\Domain\Ticket\Imports\EscalationImport;
use App\Domain\Interaction\Imports\ContactImport;
use App\Domain\Interaction\Imports\AnnouncementImport;
use App\Domain\Interaction\Imports\MailTemplateImport;
use App\Domain\General\Http\Requests\Import\ImportFormRequest;
use App\Domain\General\Imports\TodoImport;
use App\Domain\Setting\Imports\MemberImport;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class ImportController extends BaseController
{
    /**
     * Define imports classes
     *
     * @var array
     */
    protected $imports = [
        'articles'        =>   ArticleImport::class,
        'todos'           =>   TodoImport::class,
        'faqs'            =>   FaqImport::class,
        'categories'      =>   CategoryImport::class,
        'services'        =>   ServiceImport::class,
        'sliders'         =>   SliderImport::class,
        'announcements'   =>   AnnouncementImport::class,
        'contacts'        =>   ContactImport::class,
        'mails'           =>   MailImport::class,
        'mail_templates'  =>   MailTemplateImport::class,
        'block_ips'       =>   BlockIpImport::class,
        'quick_links'     =>   QuickLinkImport::class,
        'settings'        =>   SettingImport::class,
        'departments'     =>   DepartmentImport::class,
        'escalations'     =>   EscalationImport::class,
        'notes'           =>   NoteImport::class,
        'severities'      =>   SeverityImport::class,
        'statuses'        =>   StatusImport::class,
        'surveys'         =>   SurveyImport::class,
        'tickets'         =>   TicketImport::class,
        'roles'           =>   RoleImport::class,
        'users'           =>   UserImport::class,
        'members'         =>   MemberImport::class,
    ];

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(ImportFormRequest $request)
    {
        $validated = $request->validated();

        try{
            Excel::import(new $this->imports[$validated['type']](request()->except('file')), $validated['file']);
            $message = ['success', 'File Uploaded Successfully. Processing by the server'];
        }catch (\Throwable $ex) {
            $message = ['error', 'Failed To Upload The file'];
        }

        session()->flash('message', ['type' => $message[0], 'message' => $message[1]]);

        return request('redirect', false) ? Redirect::to(request('redirect')) :  Redirect::back();

    }
}