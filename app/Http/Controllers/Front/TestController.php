<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Models\Property;

class TestController extends Controller
{
    public function test(): void
    {

        $resault = Property::find(1);
        dd($resault->definition);


        /*
        $arrOtpions = Type::query()->pluck('name','id')->toArray();
        dd($arrOtpions);
        */
    }
}
