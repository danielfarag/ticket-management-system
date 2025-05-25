<?php
namespace App\Infrastructure\Http\AbstractControllers;

use Inertia\Inertia;

trait Responder{

    /**
     * Holds View Path
     *
     * @var string
     */
    protected $view = null;

    /**
     * Holds Api Resource Class
     *
     * @var string
     */
    protected $resource = null;

    /**
     * Create Custom Response
     *
     * @var callable
     */
    protected $api_response = null;
    
    /**
     * Holds Api Data
     *
     * @var array
     */
    protected $api_data = [];

    /**
     * Holds Web Data
     *
     * @var array
     */
    protected $web_data = [];

    /**
     * Holds Data To Map ApiCollection 
     *
     * @var string
     */
    protected $collection_base_key = '';

    /**
     * Check If Response Will be a Redirect Back
     *
     * @var boolean
     */
    protected $redirect_back = false;

    /**
     * Get Route
     *
     * @var boolean
     */
    protected $redirect_route = false;
    

    /**
     * Define View
     *
     * @param string $view
     * @return void
     */
    public function addView($view){
        $this->view = $view;
    }

    /**
     * Set Redirect Back Event
     *
     * @return void
     */
    public function redirectBack(){
        $this->redirect_back = true;
    }

    /**
     * Define Redirect Route And Params
     *
     * @param string $route
     * @param array $args
     * @return void
     */
    public function redirectRoute($route, $args = []){
        $this->redirect_route = [
            'route'=>$route,
            'args'=>$args
        ];
    }

    /**
     * Redirect Route params keeping  data
     *
     * @param string $route
     * @param array $args
     * @return void
     */
    public function redirectRouteWithQueryParams($route, $args = []){
        $previousUrl = explode('?',url()->previous()); 
        
        if(count($previousUrl)==2){
            array_push($args, $previousUrl[1]);
        }

        $this->redirectRoute($route, $args);
    }
    
    /**
     * Set Flash Message Web
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public function flashMessage($type, $message){
        session()->flash('message', ['type'=>$type, 'message'=> $message]);
    }

    /**
     * User Collection
     *
     * @param Resource $resource
     * @param String $key
     * @return void
     */
    public function useCollection($resource,$key){
        $this->resource = $resource;
        $this->collection_base_key = $key;
    }

    /**
     * Set API Response
     *
     * @param callable $resource
     * @return void
     */
    public function setApiResponse(callable $response){
        $this->api_response = $response;
    }

    /**
     * Set Data
     *
     * @param String $key
     * @param boolean $value
     * @return void
     */
    public function setData($key,$value, $type='all'){
        switch ($type) {
            case 'web':
                $this->web_data[$key]=$value;
                break;
            case 'api':
                $this->api_data[$key]=$value;
                break;
            default:
                $this->api_data[$key]=$value;
                $this->web_data[$key]=$value;
                break;
        }
    }

    /**
     * Generate Response
     *
     * @return void
     */
    public function response() {
        
        if(request()->expectsJson()){
            if($this->api_response){
                $response = ($this->api_response)();
            }else{

                $data = $this->api_data[$this->collection_base_key];
                
                $response = (new $this->resource($data));
                
                unset($this->api_data[$this->collection_base_key]);
                
                $response->additional($this->api_data);
            }
    
        }else{

            if($this->redirect_back){
                $response = back()->with($this->web_data);
            }else if($this->redirect_route){
                $response = redirect()->route($this->redirect_route['route'],$this->redirect_route['args'])->with($this->web_data);
            }else{
                $response =  Inertia::render($this->view, $this->web_data);
            }
        }

        return $response;

    }

}