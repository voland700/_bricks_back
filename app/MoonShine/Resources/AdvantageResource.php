<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Advantage;

use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class AdvantageResource extends ModelResource
{
    protected string $model = Advantage::class;
    protected string $column = 'id';
    protected string $title = 'Преимущества товаров';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Switcher::make('Активено', 'active')->default(1),
                Grid::make([
                    Column::make([
                        Number::make('Сортировка', 'sort') ->default(50)->sortable() ,
                    ])->columnSpan(2),
                ]),
                Text::make('Заголовок', 'name'),
                Image::make('Изображение преимущества','img')
                    ->dir('advantages')
                    ->keepOriginalFileName()
                    ->removable()
                    ->hideOnIndex(),
                Textarea::make('Текст преимущества', 'description')->hideOnIndex(),
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
