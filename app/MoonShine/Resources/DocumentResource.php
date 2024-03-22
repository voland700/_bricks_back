<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class DocumentResource extends ModelResource
{
    protected string $model = Document::class;
    protected string $column = 'id';
    protected string $title = 'Документация для товаров';

    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Название документа', 'name'),
                File::make('File')
                    ->dir('docs')
                    ->customName(fn(UploadedFile $file, Field $field) =>  Str::random(10) . '.' . $file->extension())
                    ->removable()
            ]),
        ];
    }

    public function rules(Model $item): array
    {
        return [];
    }
}
