<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Post $post){

    return view('posts.index');
    }
    public function create(Post $post){

        return view('posts.create');
        }

    public function store(Post $post){

            return view('posts.store');
    }
}
