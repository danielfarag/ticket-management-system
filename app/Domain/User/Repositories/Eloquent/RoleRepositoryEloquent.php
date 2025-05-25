<?php

namespace App\Domain\User\Repositories\Eloquent;

use App\Domain\User\Repositories\Contracts\RoleRepository;
use App\Domain\User\Entities\Role;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class RoleRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends EloquentRepository implements RoleRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Role::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $permissions = [
        [
            'name'=> 'user',
            'permissions'  =>  [
                'create_user' => 'create user',
                'read_user' => 'read user',
                'update_user' => 'update user',
                'delete_user'=> 'delete user',
                'import_user'=> 'import users',
                'export_user'=> 'export users',
            ],
        ],
        [
            'name'=> 'role',
            'permissions'  =>  [
                'create_role' => 'create role',
                'read_role' => 'read role',
                'update_role' => 'update role',
                'delete_role'=> 'delete role',
                'import_role'=> 'import roles',
                'export_role'=> 'export roles',
            ],
        ],
        [
            'name'=> 'ticket',
            'permissions'  =>  [
                'create_ticket' => 'create ticket',
                'read_ticket' => 'read ticket',
                'update_ticket' => 'update ticket',
                'manage_ticket_categories' => 'Manage Ticket Categories',
                'delete_ticket'=> 'delete ticket',
                'import_ticket'=> 'import tickets',
                'export_ticket'=> 'export tickets',
            ],
        ],
        [
            'name'=> 'status',
            'permissions'  =>  [
                'create_status' => 'create status',
                'read_status' => 'read status',
                'update_status' => 'update status',
                'delete_status'=> 'delete status',
                'import_status'=> 'import statuses',
                'export_status'=> 'export status',
            ],
        ],
        [
            'name'=> 'severity',
            'permissions'  =>  [
                'create_severity' => 'create severity',
                'read_severity' => 'read severity',
                'update_severity' => 'update severity',
                'delete_severity'=> 'delete severity',
                'import_severity'=> 'import severities',
                'export_severity'=> 'export severities',
            ],
        ],
        [
            'name'=> 'department',
            'permissions'  =>  [
                'create_department' => 'create department',
                'read_department' => 'read department',
                'update_department' => 'update department',
                'delete_department'=> 'delete department',
                'import_department'=> 'import departments',
                'export_department'=> 'export departments',
            ],
        ],
        [
            'name'=> 'survey',
            'permissions'  =>  [
                'create_survey' => 'create survey',
                'read_survey' => 'read survey',
                'update_survey' => 'update servey',
                'delete_survey'=> 'delete servey',
                'import_survey'=> 'import surveys',
                'export_survey'=> 'export surveys',
            ],
        ],
        [
            'name'=> 'escalation',
            'permissions'  =>  [
                'create_escalation' => 'create escalation',
                'read_escalation' => 'read escalation',
                'update_escalation' => 'update escalation',
                'delete_escalation'=> 'delete escalation',
                'import_escalation'=> 'import escalations',
                'export_escalation'=> 'export escalations',
            ],
        ],
        [
            'name'=> 'announcement',
            'permissions'  =>  [
                'create_announcement' => 'create announcement',
                'read_announcement' => 'read announcement',
                'update_announcement' => 'update announcement',
                'delete_announcement'=> 'delete announcement',
                'import_announcement'=> 'import announcements',
                'export_announcement'=> 'export announcements',
            ],
        ],
        [
            'name'=> 'contact',
            'permissions'  =>  [
                'create_contact' => 'create contact',
                'read_contact' => 'read contact',
                'update_contact' => 'update contact',
                'delete_contact'=> 'delete contact',
                'import_contact'=> 'import contacts',
                'export_contact'=> 'export contacts',
            ],
        ],
        [
            'name'=> 'mail_template',
            'permissions'  =>  [
                'create_mail_template' => 'create mail template',
                'read_mail_template' => 'read mail template',
                'update_mail_template' => 'update mail template',
                'delete_mail_template'=> 'delete mail template',
                'import_mail_template'=> 'import mail templates',
                'export_mail_template'=> 'export mail templates',
            ],
        ],
        [
            'name'=> 'mail',
            'permissions'  =>  [
                'create_mail' => 'create mail',
                'read_mail' => 'read mail',
                'update_mail' => 'update mail',
                'delete_mail'=> 'delete mail',
                'import_mail'=> 'import mails',
                'export_mail'=> 'export mails',
            ],
        ],
        [
            'name'=> 'faq',
            'permissions'  =>  [
                'create_faq' => 'create faq',
                'read_faq' => 'read faq',
                'update_faq' => 'update faq',
                'delete_faq'=> 'delete faq',
                'import_faq'=> 'import faqs',
                'export_faq'=> 'export faqs',
            ],
        ],
        [
            'name'=> 'article',
            'permissions'  =>  [
                'create_article' => 'create article',
                'read_article' => 'read article',
                'update_article' => 'update article',
                'manage_article_categories' => 'Manage Article Categories',
                'manage_article_tags' => 'Manage Article Tags',
                'delete_article'=> 'delete article',
                'import_article'=> 'import articles',
                'export_article'=> 'export articles',
            ],
        ],
        [
            'name'=> 'block_ip',
            'permissions'  =>  [
                'create_block_ip' => 'manage block ip',
                'read_block_ip' => 'manage block ip',
                'update_block_ip' => 'manage block ip',
                'delete_block_ip' => 'manage block ip',
                'import_block_ip'=> 'import block ips',
                'export_block_ip'=> 'export block ips',
            ],
        ],
        [
            'name'=> 'quick_link',
            'permissions'  =>  [
                'create_quick_link' => 'create quick link',
                'read_quick_link' => 'read quick link',
                'update_quick_link' => 'update quick link',
                'delete_quick_link'=> 'delete quick link',
                'import_quick_link'=> 'import quick links',
                'export_quick_link'=> 'export quick links',
            ],
        ],
        [
            'name'=> 'service',
            'permissions'  =>  [
                'create_service' => 'create service',
                'read_service' => 'read service',
                'update_service' => 'update service',
                'delete_service'=> 'delete service',
                'import_service'=> 'import services',
                'export_service'=> 'export services',
            ],
        ],
        [
            'name'=> 'slider',
            'permissions'  =>  [
                'create_slider' => 'create slider',
                'read_slider' => 'read slider',
                'update_slider' => 'update slider',
                'delete_slider'=> 'delete slider',
                'import_slider'=> 'import sliders',
                'export_slider'=> 'export sliders',
            ],
        ],
        [
            'name'=> 'member',
            'permissions'  =>  [
                'create_member' => 'create member',
                'read_member' => 'read member',
                'update_member' => 'update member',
                'delete_member'=> 'delete member',
                'import_member'=> 'import members',
                'export_member'=> 'export members',
            ],
        ],
        [
            'name'=> 'todo',
            'permissions'  =>  [
                'create_todo' => 'create todo',
                'read_todo' => 'read todo',
                'update_todo' => 'update todo',
                'delete_todo'=> 'delete todo',
                'import_todo'=> 'import todos',
                'export_todo'=> 'export todos',
            ],
        ],
        [
            'name'=> 'settings',
            'permissions'  =>  [
                'manage_settings' => 'manage settings',
                'import_settings'=> 'import settings',
                'export_settings'=> 'export settings',
            ],
        ],
    ];
}