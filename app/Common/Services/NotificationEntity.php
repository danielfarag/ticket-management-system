<?php
namespace App\Common\Services;

use ReflectionClass;

class NotificationEntity{

    
    public static function generate($entity, $route)
    {
        return [
            'type'=>(new ReflectionClass($entity))->getShortName(),
            'id' => $entity->id,
            'url' => route($route, $entity->id),
            'created_at' => date('Y-m-d H:i:s'),
            'model' => $entity,
        ];  
    }
}
