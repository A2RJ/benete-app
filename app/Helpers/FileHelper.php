<?php

namespace App\Helpers;

use Carbon\Carbon;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

    public static function isDevelopment($fileName)
    {
        return env('APP_ENV') == 'local' ? public_path($fileName) : public_path("../$fileName");
    }

    public static function zip(string $fileName, array $arrayFile)
    {
        $zipName = Carbon::now()->format('Y-M-d') . " " . $fileName . ".zip";
        $withFolder = self::isDevelopment($zipName);

        if (File::exists($withFolder)) {
            File::delete($withFolder);
        }

        $zip = new Zip();
        $zip->create($zipName);
        $zip->add(self::isDevelopment("$fileName.xlsx"));
        foreach ($arrayFile as $file) {
            if (Storage::disk('local')->exists($file)) {
                $zip->addFromString(self::getFileName($file), Storage::get($file));
            }
        }
        $zip->close();

        if (File::exists($withFolder)) {
            return response()->download($withFolder);
        } else {
            return response()->json(['message' => "If file doesn't downloaded please reload this page"]);
        }
    }

    public static function zipDokumentasi(string $fileName, $arrayFile)
    {
        $zipName = Carbon::now()->format('Y-M-d') . " " . $fileName . ".zip";
        $withFolder = self::isDevelopment($zipName);

        if (File::exists($withFolder)) {
            File::delete($withFolder);
        }

        $zip = new Zip();
        $zip->create($zipName);
        $zip->add(self::isDevelopment("$fileName.xlsx"));
        foreach ($arrayFile as $file) {
            if (Storage::disk('local')->exists($file['name'])) {
                $folder = $file['dokumentasi']['id'];
                $zip->addFromString("$folder/" . self::getFileName($file['name']), Storage::get($file['name']));
            }
        }
        $zip->close();

        if (File::exists($withFolder)) {
            return response()->download($withFolder);
        } else {
            return response()->json(['message' => "If file doesn't downloaded please reload this page"]);
        }
    }


    public static function getFileName($filePath)
    {
        $parts = explode('/', $filePath);
        $fileName = end($parts);
        return $fileName;
    }
}
