<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Property;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

use MoonShine\Decorations\Divider;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Decorations\Grid;
use MoonShine\Decorations\Column;
use MoonShine\Fields\Json;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;

class ProductResource extends ModelResource
{
    protected string $model = Product::class;
    protected string $title = 'Товары каталога';
    protected string $column = 'name';
    protected array $with = ['properties'];

    public function fields(): array
    {
        return [

            Grid::make([
                Column::make([
                    Block::make([
                        ID::make()->sortable(),
                        Grid::make([
                            Column::make([
                                Switcher::make('Активен', 'active')->default(1),
                            ])->columnSpan(6),
                            Column::make([
                                Switcher::make('На главной', 'main')->default(0),
                            ])->columnSpan(6),
                        ]),
                        Divider::make(),
                        Grid::make([
                            Column::make([
                                Number::make('Сортировка', 'sort')->default(50)->sortable() ,
                            ])->columnSpan(4),
                            Column::make([
                                Text::make('Артикул', 'sku')->showOnExport(),
                            ])->columnSpan(4),
                            Column::make([
                                Text::make('ID - pechnik.su', 'pechnik_id')->showOnExport(),
                            ])->columnSpan(4),
                        ]),
                        Divider::make('Метки товара'),
                        Grid::make([
                            Column::make([
                                Switcher::make('Хит', 'hit')->default(0),
                            ])->columnSpan(3),
                            Column::make([
                                Switcher::make('Новинка', 'new')->default(0),
                            ])->columnSpan(3),
                            Column::make([
                                Switcher::make('Скидка', 'stock')->default(0),
                            ])->columnSpan(3),
                            Column::make([
                                Switcher::make('Советуем', 'advice')->default(0),
                            ])->columnSpan(3),
                        ]),
                        Divider::make('Данные товара'),
                        Text::make('Название товара', 'name')->required()->showOnExport(),
                        Slug::make('Slug')->from('name')->separator('-')->unique()->hideOnIndex(),
                        BelongsTo::make('Категории товара', 'category', resource: new CategoryResource())
                            ->nullable()
                            ->searchable(),
                        Divider::make('Изображения  товара'),
                        Grid::make([
                            Column::make([
                                MediaLibrary::make('Основное изображение', 'image')->removable()->hideOnIndex()->showOnExport(),
                            ])->columnSpan(6),
                            Column::make([
                                MediaLibrary::make('Изображение анонса', 'prev')->removable()->showOnExport(),
                            ])->columnSpan(6),
                            Column::make([
                                MediaLibrary::make('Дополнительные изображения', 'more')->removable()->multiple()->hideOnIndex()->showOnExport(),
                            ])->columnSpan(12),
                        ]),
                        Divider::make(),
                        Grid::make([
                            Column::make([
                                Text::make('Цена', 'price')->default(0)->showOnExport()->useOnImport(),
                            ])->columnSpan(6),
                        ]),

                        Text::make('Ссылка для парсинга', 'source')
                            ->copy()
                            ->hideOnIndex(),

                        //Divider::make('Преимущества в карточеке товара'),
                        BelongsToMany::make('Преимущества товара', 'advantages', 'name')
                            ->selectMode()
                            ->hideOnIndex(),
                        //Divider::make('Видо ролики с YouTube для товара'),
                        Json::make('Видео на сранице товара', 'video')
                            ->fields([
                                Text::make('code', 'code'),
                                Text::make('title', 'title')
                            ])->removable()->hideOnIndex()->showOnExport(),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Block::make([
/*
                        BelongsTo::make('Тип характеристики', 'type', )
                            ->nullable(),
*/
                        BelongsToMany::make(
                            'Properties',
                            'properties',
                            fn($item) => $item->definition)
                            ->fields([
                                Text::make('Value', 'value'),
                            ])
                    ])
                ])->columnSpan(6)
            ]),
            Divider::make(),
            Grid::make([
                Column::make([
                    Block::make('SEO, META - данные траницы товара', [
                        Text::make('Заголовок H1', 'h1')->hideOnIndex()->showOnExport(),
                        Textarea::make('Meta title', 'meta_title')->hideOnIndex()->showOnExport(),
                        Textarea::make('Meta description', 'meta_description')->hideOnIndex()->showOnExport(),
                        Text::make('Meta keywords', 'meta_keywords')->hideOnIndex()->showOnExport(),
                    ]),
                    Block::make('Описания товара', [
                        Textarea::make('Краткое описание', 'summary')->hideOnIndex()->showOnExport(),
                        Textarea::make('Детальное описание', 'description')->hideOnIndex()->showOnExport(),
                    ]),
                ])->columnSpan(12),


            ])






        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => 'required',
            'sort' => 'integer|nullable',
            'pechnik_id' => 'integer|nullable',
            'price' => 'decimal:0'
        ];
    }
}
