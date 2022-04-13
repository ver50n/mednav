<?php
namespace App\Utils;

use Lang;

class FileUtil
{
    public static function upload($pathName, $file, $name = null, $disk = 'public')
    {
        $fullPath = '';
        if(!$name)
            $name = self::generateFileName();

        $extension = $file->getClientOriginalExtension();
        $file = self::compression($pathName, $file);
        $targetName = $name . ".$extension";
        
        switch($disk) {
            case 'public' :
                $filePath = config('image.path.' . $pathName) . $targetName;
                $res = \Storage::disk($disk)->put($filePath, $file);
                break;
        }

        return $targetName;
    }

    public static function compression($pathName, $file)
    {
        $imageSize = config('image.size.' . $pathName);
        
        if(!$imageSize)
            return file_get_contents($file);
            
        $image = \Image::make($file->getRealPath());
        if($image->width() > $imageSize['width'] || $image->height() > $imageSize['height']) {
            $image = $image->resize(
                $imageSize['width'],
                $imageSize['height'],
                function($constraint) {
                    $constraint->aspectRatio();
                }
            );
        }
        $image = $image->encode('png')->stream()->__toString();

        return $image;
    }

    public static function generateFileName($type = null)
    {
        $fileName = time();
        return $fileName;
    }

    public static function getImageUrl($pathName, $fileName, $disk = 'public')
    {
        if(!$pathName)
            return $fileName;

        if(!$fileName)
            return '/images/no-profile.png';

        $fullPath = '';
        switch($disk) {
            case 's3' :
                $filePath = config('app.env') . config('s3.' . $pathName) . $fileName;
                $fullPath = \Storage::disk($disk)->url($filePath);
                break;
            case 'public' :
                $filePath = config('image.path.' . $pathName) . $fileName;
                $fullPath = \Storage::disk($disk)->url($filePath);
                break;
        }
        return $fullPath;
    }

    public static function removeImage($pathName, $fileName, $disk = 'public')
    {
        $filePath = config('app.env') . config('s3.' . $pathName) . $fileName;

        if(\Storage::disk($disk)->exists($filePath)) {
            \Storage::disk($disk)->delete($filePath);
        }
    }
}