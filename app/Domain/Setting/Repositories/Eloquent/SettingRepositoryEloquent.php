<?php

namespace App\Domain\Setting\Repositories\Eloquent;

use App\Domain\Setting\Repositories\Contracts\SettingRepository;
use App\Domain\Setting\Entities\Setting;
use App\Infrastructure\AbstractRepositories\EloquentRepository;

/**
 * Class SettingRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SettingRepositoryEloquent extends EloquentRepository implements SettingRepository
{
    /**
     * Model Name
     * @var String
     */
    protected $model_class = Setting::class;

    /**
     * Define Settings Images
     * @var array
     */
    protected $files = [
        'logo',
        'footer_logo',
    ];

    /**
     * Store settings
     *
     * @param array $settings
     * @return boolean
     */
    public function getData(){

        $data = [];
        
        $settings = $this->all();

        foreach($settings as $setting){
            if(in_array($setting->key, $this->files)){
                $data[$setting->key] = $setting->getFirstMediaUrl($setting->key);
            }else{
                $data[$setting->key] = $setting->value;
            }
        }
        
        return $data;
    }

        /**
     * Store settings
     *
     * @param array $settings
     * @return boolean
     */
    public function store($settings){

        $this->saveFiles($settings);

        $this->savePrimitives($settings);
        
        return true;
    }


    private function saveFiles($settings){
        $files = array_filter(array_filter($settings, function($key){ return in_array($key,$this->files); }, ARRAY_FILTER_USE_KEY  ));
        
        $this->whereIn('key', array_keys($files))->delete();

        foreach($files as $key=>$image){
            $setting = $this->getModel()->create(['key'=>$key, 'value'=>'']);

            $setting->addMedia($image)->toMediaCollection($key);
        }
    }

    private function savePrimitives($settings){
        $primitaves = array_diff_key($settings, array_flip($this->files));

        $formating = array_map(function($key, $value){
            return [
                'key'=>$key,
                'value'=>$value
            ];
        },array_keys($primitaves),$primitaves);
        
        $this->whereIn('key', array_keys($primitaves))->delete();

        $this->getModel()->insert($formating);

        
    }

}