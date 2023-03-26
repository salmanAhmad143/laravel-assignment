<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $client;
    protected $apiUrl;

    public function __construct()
    {
        $this->middleware(function($request, $next){	
            $user = Session::get('user');
            $this->apiUrl = config('app.api_url');
            $this->client = Http::withHeaders([
                'Authorization' =>  (isset($user['token'])) ? $user['token'] : null,
                'Content-Type' => 'application/json' 
            ]);
			return $next($request);
		});
    }
}
