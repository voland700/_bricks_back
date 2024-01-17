<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//FRONT
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Главная', route('index'));
});

// - Masters list
Breadcrumbs::for('master.list', function (BreadcrumbTrail $trail) {
    $trail->parent('index');
    $trail->push('Печники', route('master.index'));
});
// - Master detail
Breadcrumbs::for('master.detail', function (BreadcrumbTrail $trail, App\Models\Master $master) {
    $trail->parent('index');
    $trail->push('Печники', route('master.index'));
    $trail->push($master->name, route('master.item', $master));
});
