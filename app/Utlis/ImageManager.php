<?php
namespace App\Utlis;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class ImageManager{
    public static function uploadImages($images, $folder)
    {
        $paths = [];
        
            foreach ($images as $image) {

            $imageName = self::generateImageName($image);

            $path = self::storeImageInLocal($image, $folder, $imageName);

            $paths[] = $path;
        }

        
        

        return $paths;
    }
    public static function uploadImage($image, $folder)
    {
            $imageName = self::generateImageName($image);
            $path = self::storeImageInLocal($image, $folder, $imageName);
        return $path;
    }

     public static function generateImageName($image)
    {
        return Str::uuid() . '.' . $image->getClientOriginalExtension();
    }

public static function storeImageInLocal($image, $folder, $imageName)
{
    $folderPath = public_path($folder);

    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0755, true);
    }

    $image->move($folderPath, $imageName);

    return $folder . '/' . $imageName;
}

    public static function cheakimagelocal($image){
        if(File::exists(public_path($image))){
            File::delete(public_path($image));
        }
    }

 public static function deleteimage($imagePath)
{
    if ($imagePath && File::exists(public_path($imagePath))) {
        File::delete(public_path($imagePath));
    }
}

}

