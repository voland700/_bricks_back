<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Master;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\Email;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Phone;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Slug;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use VI\MoonShineSpatieMediaLibrary\Fields\MediaLibrary;


class MasterResource extends ModelResource
{
    protected string $model = Master::class;

    protected string $title = 'Печники';
    public string $column = 'name';

    public function fields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Block::make([
                        ID::make()->sortable()->sortable(),
                        Grid::make([
                            Column::make([
                                Switcher::make('Активен', 'active')->default(1),
                            ])->columnSpan(3),
                            Column::make([
                                Switcher::make('На главной', 'main')->default(0)->hideOnIndex(),
                            ])->columnSpan(3),
                            Column::make([
                                Switcher::make('Участник НП РСПК', 'member')->default(1)->hideOnIndex(),
                            ])->columnSpan(6),
                        ]),
                        Divider::make(),
                        Grid::make([
                            Column::make([
                                Number::make('Сортировка', 'sort') ->default(50)->sortable() ,
                            ])->columnSpan(2),
                        ]),
                        Divider::make(),

                        Text::make('Фамилия, Имя', 'name')
                            ->placeholder('Иванов Иван Иванович'),
                        Slug::make('Slug')
                            ->from('name')
                            ->hideOnIndex(),

                        BelongsTo::make('Напарник', 'senior', resource: new MasterResource())
                            ->associatedWith('master_id')
                            ->nullable()
                            ->searchable(),

                        Text::make('Полное название', 'title')
                            ->placeholder('Печник Иванов Иван Иванович г. Пермь')->hideOnIndex(),

                        Grid::make([
                            Column::make([
                                Phone::make('Телефон', 'phone')
                                    ->mask('7 999 999-99-99')->hideOnIndex()
                            ])->columnSpan(6),
                            Column::make([
                                Email::make('Email')->hideOnIndex()
                            ])->columnSpan(6),
                        ]),
                        Divider::make('Написать в WhatsApp'),
                        Switcher::make('Добавить кнопку', 'whatsapp')->default(0)->hideOnIndex(),

                        Text::make('Информация о пpeдcтaвитeльстве', 'participant')
                            ->placeholder('Oфициaльный пpeдcтaвитeль Kузнeцoвa И.B. в Пермском крае')->hideOnIndex(),

                        Image::make('Подтверждающий документ','document')->removable()->hideOnIndex(),

                        Textarea::make('Краткая информация', 'brief')->hideOnIndex(),

                        Grid::make([
                            Column::make([
                                MediaLibrary::make('Основное фото', 'photo')->removable()
                            ])->columnSpan(6),
                            Column::make([
                                MediaLibrary::make('Для слайдера на главной: 400х400мм', 'small-photo')->removable()->hideOnIndex()
                            ])->columnSpan(6),
                        ]),
                        Divider::make(),
                        MediaLibrary::make('Дипломы, сертификаты', 'diploma')->multiple()->removable()->hideOnIndex(),
                        MediaLibrary::make('Примеры работ', 'example')->multiple()->removable()->hideOnIndex(),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Block::make('SEO данные',[
                        Text::make('Заголовок страницы', 'h1')->hideOnIndex(),
                        Text::make('Тег meta-title', 'meta_title')->hideOnIndex(),
                        Text::make('Тег meta-keywords', 'meta_keywords')->hideOnIndex(),
                        Textarea::make('Описание meta-description', 'meta_description')->hideOnIndex(),
                    ])
                ])->columnSpan(6)
            ])


        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
