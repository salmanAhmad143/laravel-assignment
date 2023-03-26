<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
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
                'Authorization' =>  $user['token'],
                'Content-Type' => 'application/json' 
            ]);
			return $next($request);
		});
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $store = $this->client->post("{$this->apiUrl}/books", [
            'author' => [
                'id' => $request->author
            ],
            'title' => $request->title,
            'description' => $request->description,
            "release_date" => $request->release_date,
            "isbn" => "string",
            "format"=> "string",
            "number_of_pages" => 0
        ]);

        if($store) {                
            return redirect()->route("author.detail", $request->author)->with('success', 'Book added successfully.');
        }
    }

    public function create()
    {
        $authorDetail = $this->client->get("{$this->apiUrl}/authors");    
        $authors = $authorDetail->json();
        return view('addBook', compact('authors'));
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $delete = $this->client->delete("{$this->apiUrl}/books/{$id}");
            if($delete) {                
                return redirect()->back()->with('success', 'Book deleted successfully.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
