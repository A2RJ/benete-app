<?php

namespace App\Helpers;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class FileHelper
{
    public static function uploadBatch(Request $request, array $files, string $folder = ''): array
    {
        try {
            $data = [];
            foreach ($files as $file) {
                $filename = self::upload($request, $file, $folder);
                $data[$file] = $filename;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function upload(Request $request, string $file, string $folder = ''): string
    {
        try {
            $uploadedFile = $request->file($file);
            if (!$uploadedFile) {
                throw new Exception("File {$file} is required", 422);
            }

            $extension = $uploadedFile->getClientOriginalExtension();
            $storagePath = $folder . '/' . date('Y') . '/' . date('m');
            $filename = time() . '_' . Uuid::uuid4() . '.' . $extension;

            if (!Storage::disk('local')->exists($storagePath)) {
                Storage::disk('local')->makeDirectory($storagePath);
            }

            $uploadedFile->storeAs($storagePath, $filename);

            if (!Storage::disk('local')->exists($storagePath . '/' . $filename)) {
                throw new Exception("Failed to upload file {$filename}", 500);
            }

            if ($uploadedFile->getSize() != Storage::disk('local')->size($storagePath . '/' . $filename)) {
                throw new Exception("Failed to upload file {$filename}", 500);
            }

            return $filename;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function get($pathToImage)
    {
        try {
            if (!Storage::exists($pathToImage)) throw new Error("File $pathToImage is not exist");
            return Storage::get($pathToImage);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function readStream($pathToImage)
    {
        try {
            if (!\request()->hasValidSignature()) {
                abort(401);
            }
            if (!Storage::exists($pathToImage)) throw new Error("File $pathToImage is not exist");
            return Storage::disk('local')->readStream($pathToImage);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function toBase64($pathToImage): string
    {
        $imageData = File::get($pathToImage);
        $base64Image = 'data:image/' . File::extension($pathToImage) . ';base64,' . base64_encode($imageData);
        return $base64Image;
    }

    public static function storageBase64($pathToImage)
    {
        try {
            if (!Storage::exists($pathToImage)) throw new Error("File $pathToImage is not exist");
            $imageData = Storage::get($pathToImage);
            $file = 'data:image/' . File::extension($pathToImage) . ';base64,' . base64_encode($imageData);
            return $file;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
