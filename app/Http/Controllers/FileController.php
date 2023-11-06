<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\Dokumentasi;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

/**
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Dokumentasi $dokumentasi)
    {
        Validator::make($request->all(), [
            'image' => 'required',
            'image.*' => "mimes:jpeg,png,jpg,gif"
        ])->validate();

        $role = User::whereId(Auth::id())->first();
        $role = $role->roles[0]->name;

        $fileName = collect([]);
        foreach ($request->file('image') as $uploadedFile) {
            $extension = $uploadedFile->getClientOriginalExtension();
            $storagePath = "dokumentasi/$role" . '/' . date('Y') . '/' . date('M');

            $currentDateTime = Carbon::now();
            $uuid = Uuid::uuid7($currentDateTime);
            $formattedDateTime = $currentDateTime->format('Y-M-d H:i:s');
            $filename = $formattedDateTime . ' ' . request()->nama . ' ' . $uuid . '.' . $extension;
            $filename = str_replace(':', '-', $filename);
            $fullFilePath = $storagePath . '/' . $filename;

            $uploadedFile->storeAs($storagePath, $filename, 'local');

            if (!Storage::disk('local')->exists($fullFilePath)) {
                throw new Exception("Failed to upload file {$filename}", 500);
            }

            $fileName->push(['name' => $fullFilePath]);
        }

        $dokumentasi->files()->createMany($fileName->toArray());

        return back()
            ->with('success', 'File created successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($dokumentasiId, $fileId)
    {
        File::whereId($fileId)->whereDokumentasiId($dokumentasiId)->delete();

        return back()
            ->with('success', 'File deleted successfully');
    }
}
