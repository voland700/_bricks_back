<?php

namespace App\Imports;

use App\Models\Master;
use Illuminate\Http\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class MastersImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $data = [];
            $data['name'] = $row[1];
            $data['slug'] = $row[2];
            $data['title'] = $row[3] ?? null;
            $data['active'] = 1;
            $data['sort'] = $row[5] ?? 50;
            $data['main'] = $row[6] ? 1 : 0;
            $data['master_id'] = $row[7] ?? null;
            $data['email'] = $row[8] ?? null;
            $data['phone'] = $row[9] ?? null;
            $data['member'] = $row[10] ? 1 : 0;
            $data['whatsapp'] = $row[11] ? 1 : 0;
            $data['participant'] = $row[12] ?? null;
            if( $row[13]) {
                if (Storage::disk('public')->exists($row[13])){
                    $ext = pathinfo(storage_path().$row[13], PATHINFO_EXTENSION);
                    $fileName = time() . '_' . Str::lower(Str::random(5)) . '.' . $ext;
                    $path_to = '/images/masters/diploma/';
                    $path = Storage::disk('public')->putFileAs($path_to, new File('storage'.$row[13]), $fileName);
                    $data['document'] = 'storage/' . $path;
                }
            } else {
                $data['document'] = NULL;
            }
            $data['brief'] = $row[14] ?? null;
            $data['h1'] = $row[15] ?? null;
            $data['meta_title'] = $row[16] ?? null;
            $data['meta_description'] = $row[17] ?? null;
            $data['meta_keywords'] = $row[18] ?? null;
            $data['location'] = $row[23] ?? null;

            $master = Master::create($data);


            if( $row[19]) {
                if (Storage::disk('public')->exists($row[19])){
                    $img = 'storage'.$row[19];
                    $master
                        ->addMedia($img)
                        ->preservingOriginal()
                        ->toMediaCollection('photo');
                }
            }

            if( $row[20]) {
                if (Storage::disk('public')->exists($row[20])){
                    $img = 'storage'.$row[20];
                    $master
                        ->addMedia($img)
                        ->preservingOriginal()
                        ->toMediaCollection('small-photo');
                }
            }

            if($row[21]) {
                $certificates = explode( ',', $row[21]);
                foreach ($certificates as $certificate){
                    if (Storage::disk('public')->exists($certificate)){
                        $img = 'storage'.$certificate;
                        $master
                            ->addMedia($img)
                            ->preservingOriginal()
                            ->toMediaCollection('diploma');
                    }

                }
            }

            if($row[22]) {
                $images = explode( ',', $row[22]);
                foreach ($images as $image){
                    if (Storage::disk('public')->exists($image)){
                        $img = 'storage'.$image;
                        $master
                            ->addMedia($img)
                            ->preservingOriginal()
                            ->toMediaCollection('example');
                    }
                }
            }
            usleep(5000);
            set_time_limit(0);
        }

    }
    public function headingRow(): int
    {
        return 2;
    }
}
