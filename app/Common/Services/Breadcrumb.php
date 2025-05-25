<?php
namespace App\Common\Services;

use Illuminate\Http\Request;

class Breadcrumb{

    /**
     * Define Breadcrumb
     *
     * @var \Illuminate\Support\Collection
     */
    private $pages;

    /**
     * Define Breadcrumb
     *
     * @var \Illuminate\Support\Collection
     */
    private $breadcumb;

    private function __construct(Request $request)
    {
        $this->pages = collect([
            'dashboard'     => ['Dashboard', route('dashboard')],
            
            'users'         => ['Users', route('users.index')],
            'create_user'   => ['Create User', route('users.create')],
            'show_user'     => [ optional($request->route('user'))->name, route('users.show', optional($request->route('user'))->id ?? 0)],
            
            'roles'         => ['Roles', route('roles.index')],
            'create_role'   => ['Create Role', route('roles.create')],
            'show_role'     => [ optional($request->route('role'))->name, route('roles.show', optional($request->route('role'))->id ?? 0)],
            
            'tickets'         => ['Tickets', route('tickets.index')],
            'create_ticket'   => ['Create Ticket', route('tickets.create')],
            'show_ticket'     => [ $this->substr(optional($request->route('ticket'))->subject). '...', route('tickets.show', optional($request->route('ticket'))->id ?? 0)],

            'statuses'         => ['Statuses', route('statuses.index')],
            'create_status'   => ['Create Status', route('statuses.create')],
            'show_status'     => [ optional($request->route('status'))->name, route('statuses.show', optional($request->route('status'))->id ?? 0)],

            'severities'         => ['Severities', route('severities.index')],
            'create_severity'   => ['Create Severity', route('severities.create')],
            'show_severity'     => [ optional($request->route('severity'))->name, route('severities.show', optional($request->route('severity'))->id ?? 0)],

            'departments'         => ['Departments', route('departments.index')],
            'create_department'   => ['Create Department', route('departments.create')],
            'show_department'     => [ optional($request->route('department'))->name, route('departments.show', optional($request->route('department'))->id ?? 0)],

            'surveys'         => ['Surveys', route('surveys.index')],
            'show_survey'     => [ $this->substr(optional(optional($request->route('survey'))->ticket)->subject). '....', route('surveys.show', optional($request->route('survey'))->id ?? 0)],

            'escalations'         => ['Escalations', route('escalations.index')],
            'create_escalation'   => ['Create Escalation', route('escalations.create')],
            'show_escalation'     => [ $this->substr(optional(optional($request->route('escalation'))->ticket)->subject). '....', route('escalations.show', optional($request->route('escalation'))->id ?? 0)],

            'announcements'         => ['Announcements', route('announcements.index')],
            'create_announcement'   => ['Create Announcement', route('announcements.create')],
            'show_announcement'     => [ $this->substr(optional($request->route('announcement'))->content). '...', route('announcements.show', optional($request->route('announcement'))->id ?? 0)],

            'contacts'         => ['Contacts', route('contacts.index')],
            'create_contact'   => ['Create Contact', route('contacts.create')],
            'show_contact'     => [ optional($request->route('contact'))->name, route('contacts.show', optional($request->route('contact'))->id ?? 0)],
        
            'mails'         => ['Mails', route('mails.index')],
            'create_mail'   => ['Create Mail', route('mails.create')],
            'show_mail'     => [ $this->substr(optional($request->route('mail'))->subject). '....', route('mails.show', optional($request->route('mail'))->id ?? 0)],

            'mail_templates'         => ['Mail Templates', route('mail_templates.index')],
            'create_mail_template'   => ['Create Mail Template', route('mail_templates.create')],
            'show_mail_template'     => [ $this->substr(optional($request->route('mail_template'))->subject). '....', route('mail_templates.show', optional($request->route('mail_template'))->id ?? 0)],
            
            'faqs'         => ['Faqs', route('faqs.index')],
            'create_faq'   => ['Create Faq', route('faqs.create')],
            'show_faq'     => [ $this->substr(optional($request->route('faq'))->question). '....', route('faqs.show', optional($request->route('faq'))->id ?? 0)],
            
            'articles'         => ['Articles', route('articles.index')],
            'create_article'   => ['Create Article', route('articles.create')],
            'show_article'     => [ $this->substr(optional($request->route('article'))->title). '....', route('articles.show', optional($request->route('article'))->id ?? 0)],
     
            'settings'     => ['Settings', route('settings.index')],
            
            'block_ips'         => ['Block IPs', route('block_ips.index')],
            'create_block_ip'   => ['Create Block IP', route('block_ips.create')],
            'show_block_ip'     => [ optional($request->route('block_ip'))->ip_address, route('block_ips.show', optional($request->route('block_ip'))->id ?? 0)],

            'quick_links'         => ['Quick Links', route('quick_links.index')],
            'create_quick_link'   => ['Create Quick Link', route('quick_links.create')],
            'show_quick_link'     => [ optional($request->route('quick_link'))->title, route('quick_links.show', optional($request->route('quick_link'))->id ?? 0)],

            'services'         => ['Services', route('services.index')],
            'create_service'   => ['Create Service', route('services.create')],
            'show_service'     => [ optional($request->route('service'))->title, route('services.show', optional($request->route('service'))->id ?? 0)],

            'sliders'         => ['Sliders', route('sliders.index')],
            'create_slider'   => ['Create Slider', route('sliders.create')],
            'show_slider'     => [ optional($request->route('slider'))->title, route('sliders.show', optional($request->route('slider'))->id ?? 0)],

            'members'         => ['Members', route('members.index')],
            'create_member'   => ['Create Member', route('members.create')],
            'show_member'     => [ optional($request->route('member'))->title, route('members.show', optional($request->route('member'))->id ?? 0)],
            
            'todos'         => ['Todos', route('todos.index')],
            'create_todo'   => ['Create Todo', route('todos.create')],
            'show_todo'     => [ optional($request->route('todo'))->subject, route('todos.show', optional($request->route('todo'))->id ?? 0)],
        ]);

        $this->breadcumb = collect(
            array_merge(
                [
                    'dashboard'=>collect([ $this->pages->get('dashboard') ]),
                ],
                $this->generateCrudIterations('user', 'users'),
                $this->generateCrudIterations('ticket', 'tickets'),
                $this->generateCrudIterations('role', 'roles'),
                $this->generateCrudIterations('status', 'statuses'),
                $this->generateCrudIterations('severity', 'severities'),
                $this->generateCrudIterations('department', 'departments'),
                $this->generateCrudIterations('survey', 'surveys'),
                $this->generateCrudIterations('escalation', 'escalations'),
                $this->generateCrudIterations('announcement', 'announcements'),
                $this->generateCrudIterations('contact', 'contacts'),
                $this->generateCrudIterations('mail', 'mails'),
                $this->generateCrudIterations('mail_template', 'mail_templates'),
                $this->generateCrudIterations('faq', 'faqs'),
                $this->generateCrudIterations('article', 'articles'),
                [
                    'settings.index'=>collect([ 
                        $this->pages->get('dashboard'),
                        $this->pages->get('settings')
                    ]),
                ],
                $this->generateCrudIterations('block_ip', 'block_ips'),
                $this->generateCrudIterations('quick_link', 'quick_links'),
                $this->generateCrudIterations('service', 'services'),
                $this->generateCrudIterations('slider', 'sliders'),
                $this->generateCrudIterations('member', 'members'),
                $this->generateCrudIterations('todo', 'todos'),
            )
        );

    }

    /**
     * Generate Breadcrumbs array
     *
     * @return array
     */
    public static function generate($request){
        $instance = new self($request);
        $breadcumb = $instance->get($request->route()->getName());

        return [
            'title' => $breadcumb->last()['label'],
            'items'=> $breadcumb,
        ];
    }
    
    /**
     * Generate Breadcrumbs array
     *
     * @return array
     */
    private function generateCrudIterations($singular, $plural){
        return[
            "$plural.index"=>collect([
                $this->pages->get("dashboard"),
                $this->pages->get("$plural"),
            ]),
            "$plural.create"=>collect([
                $this->pages->get("dashboard"),
                $this->pages->get("$plural"),
                $this->pages->get("create_$singular"),
            ]),
            "$plural.show"=>collect([
                $this->pages->get("dashboard"),
                $this->pages->get("$plural"),
                $this->pages->get("show_$singular"),
            ]),
            "$plural.edit"=>collect([
                $this->pages->get("dashboard"),
                $this->pages->get("$plural"),
                $this->pages->get("show_$singular"),
            ]),
        ];
    }

    /**
     * Generate breacrumb
     *
     * @param string $name
     * @return Collection
     */
    public function get($name){
        $breadcumb = $this->breadcumb->get($name) ?? $this->breadcumb->get('dashboard');

        return $breadcumb->map(function($page, $index) use($breadcumb){
            $item['label'] = $page[0];
            $item['url'] = $page[1];
            if($index == $breadcumb->count()-1){
                $item['active'] = true;
            }else{
                $item['active'] = false;
            }

            return $item;
        });
    }

    /**
     * Cut string
     *
     * @param string $string
     * @param integer $start
     * @param integer $end
     * @return string
     */
    private function substr($string, $start = 0, $end = 30){
        return substr($string, $start, $end);
    }
}
