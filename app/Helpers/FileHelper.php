<?php

namespace App\Helpers;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class FileHelper
{
    public $GDriveFolder = env('GOOGLE_DRIVE_FOLDER_NAME');

    public static function upload(Request $request, string $file, string $folder = ''): string
    {
        try {
            $uploadedFile = $request->file($file);
            if (!$uploadedFile) {
                throw new Exception("File {$file} is required", 422);
            }

            $extension = $uploadedFile->getClientOriginalExtension();
            $storagePath = $folder . '/' . date('Y') . '/' . date('m');
            $filename = $storagePath . '/' . time() . '_' . Uuid::uuid4() . '.' . $extension;

            if (!Storage::disk('local')->exists($storagePath)) {
                Storage::disk('local')->makeDirectory($storagePath);
            }

            $uploadedFile->storeAs($filename);

            if (!Storage::disk('local')->exists($filename)) {
                throw new Exception("Failed to upload file {$filename}", 500);
            }

            if ($uploadedFile->getSize() != Storage::disk('local')->size($filename)) {
                throw new Exception("Failed to upload file {$filename}", 500);
            }

            return $filename;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function download($pathToImage)
    {
        try {
            if (!\request()->hasValidSignature()) {
                abort(401);
            }
            if (!Storage::exists($pathToImage)) throw new Error("File $pathToImage is not exist");
            return Storage::download($pathToImage);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function checkFileExistsGDrive($fileName)
    {
        $folder = self::$GDriveFolder;
        $data = Gdrive::all('/' . $folder);
        $fileExists = collect($data)
            ->where('type', 'file')
            ->where('path', "$folder/$fileName")
            ->first();

        return $fileExists;
    }

    public static function uploadGDrive(Request $request, string $file, string $folder, string $customName)
    {
        try {
            $requestFile = $request->file($file);
            if (!$requestFile) {
                throw new Exception("File {$file} is required", 422);
            }

            $extension = $requestFile->getClientOriginalExtension();
            $fileName = $folder . '/' . date('Y') . '/' . date('m') . '/' . date('Y-m-d H:i:s') . '-' . $customName . ' ' . time() . '.' . $extension;

            Gdrive::put(self::$GDriveFolder . "/$fileName", $requestFile);

            $check = self::checkFileExistsGDrive($fileName);
            if (!$check) {
                throw new Exception("Error white uploading files", 500);
            }
            return $fileName;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function downloadGDrive($fileName)
    {
        try {
            if (!\request()->hasValidSignature()) {
                abort(401);
            }
            $check = self::checkFileExistsGDrive($fileName);
            if (!$check) {
                throw new Exception("Your file is not exist", 500);
            }
            $data = Gdrive::get('Benetestssss/docx/docx/FITUR.docx');
            return response($data->file, 200)
                ->header('Content-Type', $data->ext)
                ->header('Content-disposition', 'attachment; filename="' . $data->filename . '"');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
