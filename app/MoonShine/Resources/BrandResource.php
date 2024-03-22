<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\library\GetCategoriesTree;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Select;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;

class BrandResource extends ModelResource
{
    protected string $model = Brand::class;
    protected string $title = 'Бренды, производители товаров';
    protected string $column = 'id';

    public function fields(): array
    {
        return [
                Grid::make([
                    Column::make([
                        Column::make([
                            Block::make('Данные производителя', [
                                ID::make()->sortable()->showOnExport(),
                                Switcher::make('Активность', 'active')->onValue(1)->offValue(0)->default(1),
                                Switcher::make('На главной в слайдере', 'main')->onValue(1)->offValue(0)->default(1),
                                Text::make('Название произаодителя', 'name')->required()->showOnExport(),
                                Slug::make('Slug')->from('name')->separator('-')->unique()->hideOnIndex(),
                                Number::make('Сортировка', 'sort')->default(50)->sortable(),

                                Image::make('logo')
                                    ->dir('brands')
                                    ->keepOriginalFileName()
                                    ->allowedExtensions(['jpg', 'png'])
                                    ->removable()
                            ]),
                        ])->columnSpan(6),
                        Column::make([
                            Block::make('SEO, META- данные производителя', [
                                Text::make('Заголовок H1', 'h1')->hideOnIndex(),
                                Textarea::make('Meta title', 'meta_title')->hideOnIndex(),
                                Textarea::make('Meta description', 'meta_description')->hideOnIndex(),
                                Text::make('Meta keywords', 'meta_keywords')->hideOnIndex(),
                            ]),
                        ])->columnSpan(6),
                        Column::make([
                            Block::make('Описания Категории', [
                                Textarea::make('Текст краткого описания', 'brief')->hideOnIndex()->showOnExport(),
                                Textarea::make('Детальное описание', 'description')->hideOnIndex(),
                            ]),
                        ])->columnSpan(6),
                ])
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
