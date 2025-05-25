<?php
namespace App\Common\Services;

class DbNotification{

    /**
     * Define Breadcrumb
     *
     * @var \Illuminate\Support\Collection
     */
    private static $keys = [
        'ticket_created'=>[
            'title'=> 'Ticket Created',
            'description'=> 'New ticket has been created',
            'icon'=> 'https://img.icons8.com/flat_round/64/000000/vote-badge.png',
        ]
    ];

    /**
     * Generate Breadcrumbs array
     *
     * @return array
     */
    public static function generate($type, $entity){
        return [
            'title' => self::$keys[$type]['title'],
            'description' => self::$keys[$type]['description'],
            'icon' => self::$keys[$type]['icon'],
            'entity' => $entity,
        ];

    }
}
