<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//FRONT
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Главная', route('index'));
});

// - Masters list
Breadcrumbs::for('front.masters.list', function (BreadcrumbTrail $trail) {
    $trail->parent('front.index');
    $trail->push('Печники', route('master.index'));
});
// - Master detail
Breadcrumbs::for('front.masters.detail', function (BreadcrumbTrail $trail, App\Models\Master $master) {
    $trail->parent('front.index');
    $trail->push('Печники', route('master.index'));
    $trail->push($master->name, route('master.item', $master));
});
