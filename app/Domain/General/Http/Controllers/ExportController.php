<?php

namespace App\Domain\General\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Domain\Cms\Exports\FaqExport;
use App\Domain\User\Exports\RoleExport;
use App\Domain\User\Exports\UserExport;
use Illuminate\Support\Facades\Redirect;
use App\Domain\Cms\Exports\ArticleExport;
use App\Domain\Ticket\Exports\NoteExport;
use App\Domain\Ticket\Exports\StatusExport;
use App\Domain\Ticket\Exports\SurveyExport;
use App\Domain\Ticket\Exports\TicketExport;
use App\Domain\General\Exports\SliderExport;
use App\Domain\General\Exports\ServiceExport;
use App\Domain\Setting\Exports\BlockIpExport;
use App\Domain\Setting\Exports\SettingExport;
use App\Domain\Ticket\Exports\SeverityExport;
use App\Domain\General\Exports\CategoryExport;
use App\Domain\General\Exports\TodoExport;
use App\Domain\Interaction\Exports\MailExport;
use App\Domain\Setting\Exports\QuickLinkExport;
use App\Domain\Ticket\Exports\DepartmentExport;
use App\Domain\Ticket\Exports\EscalationExport;
use App\Domain\Interaction\Exports\ContactExport;
use App\Domain\Interaction\Exports\AnnouncementExport;
use App\Domain\Interaction\Exports\MailTemplateExport;
use App\Domain\Setting\Exports\MemberExport;
use App\Domain\User\Exports\PermissionExport;
use App\Infrastructure\Http\AbstractControllers\BaseController;

class ExportController extends BaseController
{
    /**
     * Define imports classes
     *
     * @var array
     */
    protected $imports = [
        'articles'        =>   ArticleExport::class,
        'faqs'            =>   FaqExport::class,
        'categories'      =>   CategoryExport::class,
        'services'        =>   ServiceExport::class,
        'sliders'         =>   SliderExport::class,
        'announcements'   =>   AnnouncementExport::class,
        'contacts'        =>   ContactExport::class,
        'mails'           =>   MailExport::class,
        'mail_templates'  =>   MailTemplateExport::class,
        'block_ips'       =>   BlockIpExport::class,
        'quick_links'     =>   QuickLinkExport::class,
        'settings'        =>   SettingExport::class,
        'departments'     =>   DepartmentExport::class,
        'escalations'     =>   EscalationExport::class,
        'notes'           =>   NoteExport::class,
        'severities'      =>   SeverityExport::class,
        'statuses'        =>   StatusExport::class,
        'surveys'         =>   SurveyExport::class,
        'tickets'         =>   TicketExport::class,
        'roles'           =>   RoleExport::class,
        'users'           =>   UserExport::class,
        'permissions'     =>   PermissionExport::class,
        'members'         =>   MemberExport::class,
        'todos'           =>   TodoExport::class,
    ];

    /**
     * Return View.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request, $type)
    {
        if(in_array($type, array_keys($this->imports))){
            $dummy=  $request->query('dummy', false);
            $file_name = $dummy ? 'dummy_'.$type.'.xlsx' : $type.'.xlsx';

            return Excel::download(new $this->imports[$type]($dummy), $file_name);
        }
        return Redirect::route('dashboard');
    }
}