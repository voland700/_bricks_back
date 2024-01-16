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
        $masters = Master::where('active', 1)->select('id', 'slug', 'master_id', 'sort', 'active', 'name')->orderBy('sort')->get();

        return 'null';


    }

    public function gi(Request $request): View
    {
        $id=2;
        $master = Master::query()->with('childrenMasters')->where('id', $id)->first();

        dd($master);

        /*
        $masters = Master::with('childrenMasters')->where('id', $id)->first()->toArray();

        $master[0] = $masters;

        if(!empty($masters['children_masters'])){
            $master[0]['children_masters'] = [];
            foreach ($masters['children_masters'] as $masterItem) {
                $key = 1;
                $master[$key] = $masterItem;
                $key++;
            }
        }
*/
        dd($master->url);



    }
}
