<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\controllers\contracts\CategoryInterface;
use App\http\controllers\contracts\SeoInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $category;
    private $seo;

    public function __construct(
        CategoryInterface $category,
        SeoInterface $seo
        )
    {
        $this->category = $category;
        $this->seo = $seo;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
