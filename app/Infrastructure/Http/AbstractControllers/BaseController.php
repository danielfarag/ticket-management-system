<?php

namespace App\Infrastructure\Http\AbstractControllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Responder;

    public function redirectWithQueryParams($route, $args = []){
        $previousUrl = explode('?',url()->previous()); 
        
        if(count($previousUrl)==2){
            array_push($args, $previousUrl[1]);
        }

        return Redirect::route($route, $args);
    }
}
