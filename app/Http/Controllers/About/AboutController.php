<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{	
	/*
		* Shows Privacy Policy Page
	*/
    public function policy()
    {
    	return view('about.privacy');
    }
	
	/*
		* Shows FAQs Page
	*/
    public function faq()
    {
    	return view('about.faq');
    }
	
	/*
		* Shows Sitemap Page
	*/
    public function sitemap()
    {
    	return view('about.sitemap');
    }
}
