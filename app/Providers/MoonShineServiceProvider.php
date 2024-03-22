<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Resources\AdvantageResource;
use App\MoonShine\Resources\BrandResource;
use App\MoonShine\Resources\DocumentResource;
use App\MoonShine\Resources\ProductResource;
use App\MoonShine\Resources\PropertyResource;
use App\MoonShine\Resources\TypeResource;
use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use App\MoonShine\Resources\MasterResource;
use App\MoonShine\Resources\SliderResource;
use App\MoonShine\Pages\Import\masterImport;
use App\MoonShine\Resources\CategoryResource;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    protected function resources(): array
    {
        return [];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [

            MenuGroup::make('Каталог', [

                MenuItem::make('Товары', new ProductResource())->icon('heroicons.shopping-bag'),
                MenuItem::make('Категории', new CategoryResource())->icon('heroicons.inbox-stack'),
                MenuItem::make('Названия характеристик', new PropertyResource())->icon('heroicons.queue-list'),
                MenuItem::make('Типы характеристик', new TypeResource())->icon('heroicons.square-3-stack-3d'),
                MenuItem::make('Производители', new BrandResource())->icon('heroicons.cog'),
                MenuItem::make('Преимущества товаров', new AdvantageResource())->icon('heroicons.hand-thumb-up'),
                MenuItem::make('Документация', new DocumentResource())->icon('heroicons.document'),
            ])->icon('heroicons.wallet'),





            MenuItem::make('Печники', new MasterResource())->icon('heroicons.trophy'),

            MenuGroup::make('Import/Export', [
                MenuItem::make('Импорт печников',
                    new masterImport()
                )->icon('heroicons.document-arrow-down'),
            ])->icon('heroicons.folder-arrow-down'),

            MenuGroup::make('Контент', [
                MenuItem::make('Слайдер', new SliderResource())->icon('heroicons.photo'),
            ])->icon('heroicons.document-duplicate'),


            MenuGroup::make(static fn() => __('moonshine::ui.resource.system'), [
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.admins_title'),
                   new MoonShineUserResource()
               ),
               MenuItem::make(
                   static fn() => __('moonshine::ui.resource.role_title'),
                   new MoonShineUserRoleResource()
               ),
            ]),

            MenuItem::make('Documentation', 'https://moonshine-laravel.com')
               ->badge(fn() => 'Check'),
        ];
    }

    /**
     * @return array{css: string, colors: array, darkColors: array}
     */
    protected function theme(): array
    {
        return [];
    }
}
