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
    public function download($pathToImage = false)
    {
        if (!$pathToImage) {
            return FileHelper::download($pathToImage);
        }
    }

    public function zip($ids = false, $model = false)
    {
        if ($ids && $model) {
            $data = DB::table($model)->whereIn($model . '.id', explode(',', $ids));
            $lampiran = $data->pluck('lampiran')->toArray();
            $data = $data->join('users', $model . ".user_id", 'users.id')->get();
            $fileName = $model;

            if (count($lampiran) != 0) {
                if (File::exists(FileHelper::isDevelopment("$fileName.xlsx"))) {
                    File::delete(FileHelper::isDevelopment("$fileName.xlsx"));
                }
                (new FastExcel($data))->export("$fileName.xlsx", function ($data) {
                    return [
                        'User' => $data->name,
                        'Nama Surat' => $data->nama,
                        'Tanggal Masuk' => $data->tanggal_masuk,
                        'Asal' => $data->asal,
                        'Perihal' => $data->perihal,
                        'lampiran' => FileHelper::getFileName($data->lampiran),
                    ];
                });
                return FileHelper::zip($fileName, $lampiran);
            } else {
                abort(422, 'No data to export');
            }
        } else {
            abort(422, 'No data to export');
        }
    }

    public function zipDokumentasi($ids = false)
    {
        try {
            if ($ids) {
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
                    if (File::exists(FileHelper::isDevelopment("$fileName.xlsx"))) {
                        File::delete(FileHelper::isDevelopment("$fileName.xlsx"));
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
                    abort(422, 'No data to export');
                }
            } else {
                abort(422, 'No data to export');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
