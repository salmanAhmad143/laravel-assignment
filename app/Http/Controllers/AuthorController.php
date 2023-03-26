<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authorsList = $this->client->get("{$this->apiUrl}/authors");
        $authors = $authorsList->json();
        return view('authors', compact('authors'));
    }

    public function detail($id)
    {
        if (!empty($id)) {
            $authorDetail = $this->client->get("{$this->apiUrl}/authors/{$id}");    
            $detail = $authorDetail->json();
            return view('authorDetail', compact('detail'));
        } else {
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (!empty($id)) {
            $delete = $this->client->delete("{$this->apiUrl}/authors/{$id}");
            if($delete) {                
                return redirect()->back()->with('success', 'Author deleted successfully.');
            }
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
