<?php

namespace App\Helpers;

use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use ZanySoft\Zip\Zip;

class FileHelper
{
    public static function upload(Request $request, string $file, string $folder): string
    {
        try {
            $uploadedFile = $request->file($file);
            if (!$uploadedFile) {
                throw new Exception("File {$file} is required", 422);
            }

            $extension = $uploadedFile->getClientOriginalExtension();
            $storagePath = $folder . '/' . date('Y') . '/' . date('M');

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

            return $fullFilePath;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function download($pathToImage)
    {
        try {
            if (!request()->hasValidSignature()) {
                abort(401);
            }
            if (!Storage::exists($pathToImage)) throw new Error("File $pathToImage is not exist");
            return Storage::download($pathToImage);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function zip(string $fileName, array $arrayFile)
    {
        $fileName = date('Y:M:d') . $fileName;
        $zip = new Zip();
        $zip->create("$fileName.zip");
        $zip->add($arrayFile);
        return response()->download(public_path('test.zip'));
    }
}
