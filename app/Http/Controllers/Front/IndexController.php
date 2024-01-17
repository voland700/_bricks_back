<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master;
use App\Models\Slider;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        $masters = Master::query()->where([['active', '=', 1], ['main', '=', 1]])->orderBy('sort')->select('id', 'name', 'active', 'main', 'slug', 'master_id', 'member', 'sort', 'location')->get();
        $sliders = Slider::query()->where('active', 1)->orderBy('sort')->get();
        return view('front.index', ['sliders'=> $sliders, 'categories' => null, 'masters'=>$masters, 'products'=> null]);

    }
}
