<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\library\GetCategoriesTree;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;


use MoonShine\Decorations\Block;
use MoonShine\Fields\Number;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;

class CategoryResource extends ModelResource
{
    protected string $model = Category::class;
    protected string $column = 'name';
    protected string $title = 'Категории каталога';

    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make('Данные категории', [
                        ID::make()->sortable()->showOnExport(),
                        Switcher::make('Активность', 'active')->onValue(1)->offValue(0)->default(1),
                        Text::make('Название Категории', 'name')->required()->showOnExport(),//->hideOnIndex(),

                        Slug::make('Slug')->from('name')->separator('-')->unique()->hideOnIndex(),
                        Number::make('Сортировка', 'sort')->default(50)->sortable(),
                        Select::make('Родительская категория', 'parent_id')
                            ->options(GetCategoriesTree::get()
                            )->sortable()->nullable(),


                        MediaLibrary::make('Иконка для главной', 'category_icon')->removable(),
                        MediaLibrary::make('Изображение', 'category')->removable(),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('SEO, META- данные категории', [
                        Text::make('Заголовок H1', 'h1')->hideOnIndex(),
                        Textarea::make('Meta title', 'meta_title')->hideOnIndex(),
                        Textarea::make('Meta description', 'meta_description')->hideOnIndex(),
                        Text::make('Meta keywords', 'meta_keywords')->hideOnIndex(),
                    ]),
                ])->columnSpan(6),
                Column::make([
                    Block::make('Описания Категории', [
                        Textarea::make('Текст над  списком товаров', 'brief')->hideOnIndex()->showOnExport(),
                        Textarea::make('Описание категории', 'description')->hideOnIndex(),
                    ]),
                ])->columnSpan(6),
            ])
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
