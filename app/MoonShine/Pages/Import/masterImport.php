<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Import;

use MoonShine\Components\FormBuilder;
use MoonShine\Decorations\Block;
use MoonShine\Fields\File;
use MoonShine\Pages\Page;

class masterImport extends Page
{
    protected string $title = 'Загрузка печников';
    protected string $subtitle = 'Загрузка данных о печникх из EXCEL- файла';


    public function breadcrumbs(): array
    {
        return [
            '#' => $this->title()
        ];
    }

    public function title(): string
    {
        return $this->title ?: 'masterImport';
    }

    public function components(): array
	{
		return [

            Block::make('Загрузка файла', [
                FormBuilder::make(
                    action:'/admin/masters-import',
                    method: 'POST',
                    fields: [
                        File::make('File')
                            ->dir('import')
                            ->allowedExtensions(['xlsx', 'xls', 'csv'])
                    ]
                )
            ])


        ];
	}
}
