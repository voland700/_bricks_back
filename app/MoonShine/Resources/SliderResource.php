<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Slider;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;


class SliderResource extends ModelResource
{
    protected string $model = Slider::class;

    protected string $title = 'Слайдер на главной';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Grid::make([
                    Column::make([
                        Block::make('Данные слайда', [
                            Grid::make([
                                Column::make([
                                    Switcher::make('Активен', 'active')->default(1),
                                ])->columnSpan(3),
                                Column::make([
                                    Switcher::make('Кнопка подробнее', 'button')->default(1),
                                ])->columnSpan(3),
                            ]),
                            Divider::make(),
                            Grid::make([
                                Column::make([
                                    Number::make('Сортировка', 'sort') ->default(50)->sortable() ,
                                ])->columnSpan(2),
                            ]),
                            Text::make('Заголовок', 'name'),
                            Image::make('Изображение на слайде','img')
                                ->dir('slider')
                                ->keepOriginalFileName()
                                ->removable()
                                ->hideOnIndex(),
                            Textarea::make('Контент на слайде', 'text')->hideOnIndex(),

                            Text::make('Ссылка на слайде', 'link')->nullable(),




                        ])






                    ])->columnSpan(8),
                ])





            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
