<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{ 
    public function index() {
        $tags = Tag::all();
        return response()->json(['tags' => $tags]);
    }
}
