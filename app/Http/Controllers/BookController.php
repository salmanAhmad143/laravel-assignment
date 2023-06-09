<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{

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
