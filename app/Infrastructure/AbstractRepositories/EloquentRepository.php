<?php
namespace App\Infrastructure\AbstractRepositories;

use PDOException;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class EloquentRepository extends BaseRepository
{
    /**
     * return view
     * @var boolean
     */
    protected $return_view = false;
    
    /**
     * Model Name
     * @var String
     */
    protected $model_class;

    /**
     * View Name
     * @var String
     */
    protected $view_class;

    /**
     * Set View Model
     *
     * @return this
     */
    public function view(){
        $this->return_view = true;

        $this->makeModel();
        
        return $this;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        if($this->return_view){
            return $this->view_class;
        }

        return $this->model_class;
    }

    
    /**
     * Delete record 
     * Prevent Constrains Exceptions
     *
     * @param Model $model
     * @return void
     */
    public function remove($model){
        try {
            $model->delete();
            session()->flash('message', ['type'=>'success', 'message'=> 'Record Deleted Successfully.']);

        } catch (PDOException $ex) {
            session()->flash('message', ['type'=>'error', 'message'=> 'Can Not Delete This Record. Many records may depend on this.</br> Delete them first.']);
        }

    }

}