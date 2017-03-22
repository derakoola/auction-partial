<?php

namespace App\Http\Controllers\Web\Front\V1;


class HomeController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('front.v1.home.index');
    }

    public function home()
    {
        return view('front.v1.home.home');

    }
}
