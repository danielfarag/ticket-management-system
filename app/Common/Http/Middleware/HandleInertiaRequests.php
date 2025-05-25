<?php

namespace App\Common\Http\Middleware;

use App\Common\Services\Breadcrumb;
use App\Domain\Interaction\Repositories\Contracts\AnnouncementRepository;
use App\Domain\Interaction\Repositories\Eloquent\MailTemplateRepositoryEloquent;
use App\Domain\Setting\Repositories\Contracts\QuickLinkRepository;
use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use App\Domain\Ticket\Notifications\TicketCreatedNotification;
use App\Domain\Ticket\Repositories\Contracts\EscalationRepository;
use App\Domain\Ticket\Repositories\Contracts\TicketRepository;
use App\Domain\User\Repositories\Contracts\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define Main rootView
     *
     * @param Request $request
     * @return void
     */
    public function rootView(Request $request)
    {
        if ($request->route()->getPrefix() == '/dashboard') {
            return 'admin';
        }

        return 'app';
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $settings = app()->make(SettingRepository::class)->getData();
        $announcements = app()->make(AnnouncementRepository::class)->all();
        $quickLinks = app()->make(QuickLinkRepository::class)->orderBy('priority', 'desc')->get();
        $tickets = app()->make(TicketRepository::class)->where('user_id',auth()->id())->orderByDesc('id')->get();

        $tickets_count = app()->make(TicketRepository::class)
                        ->where('solved', 'no')
                        ->when(auth()->check() && auth()->user()->type=='agent',function($q){
                            $q->whereHas('agents',function($q){
                                $q->where('users.id',auth()->id());
                            });
                        })->count();
        $escalations_count = app()->make(EscalationRepository::class)
                            ->where('status','!=','solved')
                            ->count();
        
        $website_announcements = $announcements->where('in', 'website')->values();
        $dashboard_announcements = $announcements->where('in', 'dashboard')->values();

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'can'  => $this->gerPermissions()
            ],
            'demo'=>config('app.demo'),
            'breadcrumb'=>Breadcrumb::generate($request),
            'mail_templates'=>MailTemplateRepositoryEloquent::$templates,
            'quick_links'=>$quickLinks,
            'website_announcements' => $website_announcements,
            'dashboard_announcements' => $dashboard_announcements,
            'settings' => $settings,
            'app_name'=>config('app.name'),
            'notifications'=>optional($request->user())->notifications ?? [],
            'notification_namespaces'=>[
                'ticket_created' => TicketCreatedNotification::class
            ],
            'route_name'=>Route::currentRouteName(),
            'request'=>array_merge(request()->all(), request()->route()->parameters),
            'message' => session()->has('message') ? session()->get('message') : null,
            'active_tickets'=>$tickets_count,
            'active_escalations'=>$escalations_count,
            'tickets_statistics'=>[
                'closed' => $tickets->where('solved', 'yes')->count(),
                'opened' => $tickets->where('solved', 'no')->count(),
                'total' => $tickets->count(),
            ]
        ]);
    }

    /**
     * Get User Permissions
     *
     * @return Object
     */
    private function gerPermissions(){
        $roleRepository = app()->make(RoleRepository::class);
        
        $_permissions = collect([]);

        $_groups = collect([]);

        collect($roleRepository->permissions)->map(function($group) use(&$_permissions, &$_groups){
            // Merge To Main Permissions Object
            $_permissions = $_permissions->merge(array_keys($group['permissions']));
            
            
            // Merge To Group Permission [ To Make a HasAnyPermission Feature For DropDown Menu - Aside]
            $name = $group['name'];

            $_groups[$name] = array_filter(array_keys($group['permissions']),function($action) use($name){
                return !in_array($action, ['update_'.$name, 'delete_'. $name]); 
            });

        });


        // Check If The Current User Has Permission [ Or Group Of Permissions ]
        $can = $_permissions->flip()->map(function($value, $key){
            // For Single Action
            return auth()->check() ? auth()->user()->can($key) : false;
        })->merge([
            // For Aside Menu
            'manage_users'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('user')) : false,
            'manage_roles'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('role')) : false,
            'manage_tickets'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('ticket')) : false,
            'manage_statuses'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('status')) : false,
            'manage_severities'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('severity')) : false,
            'manage_departments'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('department')) : false,
            'manage_surveys'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('survey')) : false,
            'manage_escalations'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('escalation')) : false,
            'manage_announcements'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('announcement')) : false,
            'manage_contacts'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('contact')) : false,
            'manage_mail_templates'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('mail_template')) : false,
            'manage_mails'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('mail')) : false,
            'manage_faqs'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('faq')) : false,
            'manage_articles'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('article')) : false,
            'manage_block_ips'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('block_ip')) : false,
            'manage_quick_links'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('quick_link')) : false,
            'manage_services'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('service')) : false,
            'manage_sliders'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('slider')) : false,
            'manage_members'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('member')) : false,
            'manage_todos'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('todo')) : false,
            'manage_settings'=>auth()->check() ? auth()->user()->hasAnyPermission($_groups->get('settings')) : false,
        ]);

        return $can;
    }
}
