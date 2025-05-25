<?php
namespace App\Infrastructure\AbstractRepositories;

trait RepositoryModelBinding
{
    /**
     * Get Model
     *
     * @return void
     */
    public function getRepository(){
        return $this->routeRepoBinding;
    }

    /**
     * Resolve Route Binding Using Repo
     *
     * @param string $value
     * @param mix $field
     * @return mix
     */
    public function resolveRouteBinding($value, $field = null){
        if($this->getRepository()){
            $repo = app()->make($this->getRepository());
            return $repo->findWhere( [$this->getRouteKeyName()=> $value])->first() ?? abort(404);
        }else{
            return $this->where('id',$value)->first() ?? abort(404); 
        }
    }
}