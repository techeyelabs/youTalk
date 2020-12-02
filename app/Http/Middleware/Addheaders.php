<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;


class Addheaders {
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin:',  '*');
        $response->header('Access-Control-Allow-Methods:',  'POST, GET, OPTIONS, PUT, DELETE');
        $response->header('Access-Control-Allow-Headers:',  'Content-Type, X-Auth-Token, Origin, Authorization'); 
        
        return $response;
    }
}