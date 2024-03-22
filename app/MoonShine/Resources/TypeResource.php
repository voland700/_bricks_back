<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class TypeResource extends ModelResource
{
    protected string $model = Type::class;
    protected string $title = 'Типы, категории характеристик товаров';
    protected string $column = 'name';

    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make([
                        ID::make()->sortable(),
                        Text::make('Тип характеристики', 'name')
                            ->placeholder('Название типа характеристики'),
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
