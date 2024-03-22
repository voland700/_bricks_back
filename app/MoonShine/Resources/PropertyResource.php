<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

use MoonShine\Decorations\Column;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Number;

use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

class PropertyResource extends ModelResource
{
    protected string $model = Property::class;
    protected string $column = 'name';
    protected string $title = 'Названия характеристик товаров';
    protected array $with = ['type'];

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable()->showOnExport(),
                Grid::make([
                    Column::make([
                        Block::make([
                            Grid::make([
                                Column::make([
                                    Number::make('Сортировка', 'sort')->default(50)->sortable()->showOnExport(),
                                ])->columnSpan(6),
                                Column::make([
                                    Switcher::make('Участвует в сортировке', 'is_filter')
                                        ->default(0)
                                        ->updateOnPreview()
                                        ->showOnExport(),
                                ])->columnSpan(6),
                            ]),
                            Select::make('Принадлежит  типу', 'type_id')
                                ->options(
                                   fn() => Type::query()->pluck('name','id')->toArray()
                                )
                                ->nullable()
                                ->nullable()
                                ->showOnExport(),
                            Text::make('Название характеристики', 'name')
                                ->placeholder('Название характеристики товара')
                                ->showOnExport(),
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
    public function filters(): array
    {
        return [
            BelongsTo::make('Типы характеристик', 'type', resource: new TypeResource())
                ->nullable()
                ->searchable()
        ];
    }
}
