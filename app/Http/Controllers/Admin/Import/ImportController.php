<?php

namespace App\Http\Controllers\Admin\Import;

use App\Imports\MastersImport;
use MoonShine\Http\Controllers\MoonShineController;
use MoonShine\MoonShineRequest;
use Symfony\Component\HttpFoundation\Response;

class ImportController extends MoonShineController
{
    public function importMasters(MoonShineRequest $request): Response
    {
        $file = $request->file('file')->store('import');
        $import = new MastersImport;
        $import->import($file);
        $this->toast('Данные загружены');
        return back();
    }
}
