<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $Slides = Slider::get();

        $Pages = Page::where('status',1)->get();
        return view("front.home.index",compact('Pages','Slides'));
    }

    public function getPage($id)
    {
        $Page = Page::where('id',$id)->first();
        return view("front.pages.show",compact('Page'));
    }

}
