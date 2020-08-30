<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function policy()
    {
    	return view('about.privacy');
    }


    public function sitemap()
    {
    	return view('about.sitemap');
    }
}
