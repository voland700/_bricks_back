<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master;

class ModifyController extends Controller
{
    public function addlocations()
    {
        $data =[
            ['url' => 'yatskov-mikhail', 'sity' => 'г. Mocквa'],
            ['url' => 'matasov-andrej', 'sity' => 'г. Mocквa'],
            ['url' => 'andryushchenko-pavel', 'sity' => 'г. Mocквa'],
            ['url' => 'obolenskij-yurij', 'sity' => 'г. Mocквa'],
            ['url' => 'obolenskij-vitalij', 'sity' => 'г. Mocквa'],
            ['url' => 'shpanagel-igor', 'sity' => 'г. Энгельс'],
            ['url' => 'vojdakov-evgenij', 'sity' => 'г. Mocквa'],
            ['url' => 'popov-evgenij', 'sity' => 'г. Липецк'],
            ['url' => 'sergej-carev', 'sity' => 'г. Mocквa'],
            ['url' => 'kuznetsov-viktor', 'sity' => 'г. Eкaтepинбуpг'],
            ['url' => 'dgamshed-ershov', 'sity' => 'г. Mocквa'],
            ['url' => 'pozdnyakov-oleg', 'sity' => 'г. Астрахань'],
            ['url' => 'voronkov-dmitrij', 'sity' => 'г. Валдай'],
            ['url' => 'zhuravlev-andrej', 'sity' => 'г. Иркутск'],
            ['url' => 'aleksandr-kondratev', 'sity' => 'г. Ульяновск'],
            ['url' => 'andrej-andreev', 'sity' => 'г.Санкт-Петербург'],
            ['url' => 'simutin-sergej', 'sity' => 'г. Mocквa'],
            ['url' => 'stas-denisov-ispania', 'sity' => 'Испания'],
            ['url' => 'morzhakov-andrej', 'sity' => 'г. Mocквa'],
            ['url' => 'pavlov-sergej', 'sity' => 'Смоленская область'],
            ['url' => 'zhovnirovich-artem', 'sity' => 'г. Воронеж'],
            ['url' => 'necaev_ruslan', 'sity' => 'г. Mocквa']
        ];
        foreach ($data as $item){
            $master = Master::query()->where('slug', $item['url'])->first();
            $master->location = $item['sity'];
            $master->save();
        }
        return 'OK';
    }
}
