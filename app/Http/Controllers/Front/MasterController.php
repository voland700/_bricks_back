<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master;
use Illuminate\View\View;

class MasterController extends Controller
{
    public function index(): View
    {
        $masters = Master::where('active', 1)->select('id', 'slug', 'master_id', 'sort', 'active', 'name')->orderBy('sort')->paginate(24);

        return view('front.masters.list', ['masters'=> $masters]);
    }

    public function master(Request $request): View
    {
        $master = Master::query()->with('childrenMasters')->where('slug', $request->slug)->first();
        $diplomas = [];
        $examples =[];
        $diplomaItems = $master->getMedia('diploma');
        $exampleItems = $master->getMedia('example');
        if($diplomaItems->count()) {
            foreach ($diplomaItems as $diplomaItem) array_push($diplomas, $diplomaItem->getUrl());
        }
        if($exampleItems->count()) {
            foreach ($exampleItems as $exampleItem) array_push($examples, $exampleItem->getUrl());
        }
        if($master->childrenMasters){
            foreach($master->childrenMasters as $childrenMaster){
                $diplomaItems = $childrenMaster->getMedia('diploma');
                $exampleItems = $childrenMaster->getMedia('example');
                if($diplomaItems->count()) {
                    foreach ($diplomaItems as $diplomaItem) array_push($diplomas, $diplomaItem->getUrl());
                }
                if($exampleItems->count()) {
                    foreach ($exampleItems as $exampleItem) array_push($examples, $exampleItem->getUrl());
                }
            }
        }
        return view('front.masters.detail', ['master'=> $master, 'diplomas' => $diplomas, 'examples'=>$examples]);
    }
}
