<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\Dokumentasi;
use App\Models\File as ModelsFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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

    // Route::get('zip/{ids?}', function ($ids) {
    // if ($ids) {
    // langsung pakai model dokuemntasi
    // $model = new $model;
    // $model->whereHas('')
    // $data = DB::table($model)->whereIn('id', explode(',', $ids))
    //     ->join($file, "$file.$model" . "_id", '=', "$model.id")
    //     ->pluck('name')->toArray();
    // if (count($data) != 0) {
    //     $fileName = Carbon::now()->format('Y-M-d') . " $model.zip";
    //     return FileHelper::zip($fileName, $data);
    // }
    // }
    // })->name('export-data');
    public function zipDokumentasi(string $ids)
    {
        try {
            $id = Auth::id();
            $user = User::whereId($id)->firstOrFail();
            $role = $user->roles[0]->name;

            $dokumentasi = Dokumentasi::query()
                ->whereRole($role)
                ->whereIn('id', explode(',', $ids))
                ->with(['user', 'files'])
                ->get()
                ->toArray();

            $files = ModelsFile::query()
                ->whereIn('dokumentasi_id', explode(',', $ids))
                ->with('dokumentasi')
                ->get()
                ->toArray();

            $fileName = "$role - dokumentasi";
            if (count($dokumentasi) != 0) {
                if (File::exists(public_path("$fileName.xlsx"))) {
                    File::delete(public_path("$fileName.xlsx"));
                }
                (new FastExcel($dokumentasi))->export("$fileName.xlsx", function ($data) {
                    $title = $data['title'];
                    $folder = $data['id'];
                    $count = count($data['files']);
                    return [
                        'User' => $data['user']['name'],
                        'Title' => $title,
                        'Type' => $data['type'],
                        'Detail' => $data['type'] == 'link' ? $data['link'] : "Di dalam folder $folder terdapat $count file",
                    ];
                });
                return FileHelper::zipDokumentasi($fileName, $files);
            } else {
                abort(500, 'No data to export');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
