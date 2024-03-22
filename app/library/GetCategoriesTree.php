<?php

namespace App\library;

use App\Models\Category;
use Illuminate\Support\Arr;
class GetCategoriesTree
{
    static function get()
    {
        $nodes = Category::defaultOrder()->withDepth()->orderBy('sort')->get();
        $tree = [];
        foreach ($nodes as $key => $item){
            $count = strlen($item->name) + $item->depth*2;
            $tree = Arr::add($tree, $item->id, str_pad($item->name, $count, "- ", STR_PAD_LEFT));
        }
        return $tree;
    }

    static  function  all()
    {
        $nodes = Category::defaultOrder()->withDepth()->orderBy('sort')->get()->toArray();
        $mapped = Arr::map($nodes, function (array $item) {
            $count = strlen($item['name']) + $item['depth']*2;
            return  [
                'value'=>$item['id'],
                'label'=>str_pad($item['name'], $count, "- ", STR_PAD_LEFT),
                'selected' => false,
            ];
        });
        return $mapped;

    }
    static  function  tree()
    {
        $nodes = Category::defaultOrder()->withDepth()->orderBy('sort')->get();
        $tree = [];
        foreach ($nodes as $item){
            $count = strlen($item->name) + $item->depth*2;
            $tree = Arr::add($tree, $item->id, str_pad($item->name, $count, "- ", STR_PAD_LEFT));
        }
        return $tree;
    }
}
