<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class FileUtilityController extends Controller
{
    public function download(string $pathToImage)
    {
        return FileHelper::download($pathToImage);
    }

    public function zip(string $ids, string $model)
    {
        if ($ids) {
            $data = DB::table($model)->whereIn($model . '.id', explode(',', $ids));
            $lampiran = $data->pluck('lampiran')->toArray();
            $data = $data->join('users', $model . ".user_id", 'users.id')->get();

            if (count($lampiran) != 0) {
                if (File::exists(public_path("$model.xlsx"))) {
                    File::delete(public_path("$model.xlsx"));
                }
                (new FastExcel($data))->export("$model.xlsx", function ($data) {
                    return [
                        'User' => $data->name,
                        'Nama Surat' => $data->nama,
                        'Tanggal Masuk' => $data->tanggal_masuk,
                        'Asal' => $data->asal,
                        'Perihal' => $data->perihal,
                        'lampiran' => FileHelper::getFileName($data->lampiran),
                    ];
                });
                return FileHelper::zip($model, $lampiran);
            } else {
                abort(500, 'No data to export');
            }
        } else {
            abort(500, 'No data to export');
        }
    }
}
