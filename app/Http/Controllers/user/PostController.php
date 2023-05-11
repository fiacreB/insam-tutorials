<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

class PostController extends Controller
{

    public function contact()
    {
        return view('frontend.pages.contact');
    }
}
