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
        return $image->storeAs(
            $folder,
            $imageName,
            'uploads'
        );
    }

    public static function cheakimagelocal($image){
        if(File::exists(public_path($image))){
            File::delete(public_path($image));
        }
    }

    public static function deleteimage($imagePath){
          if ($imagePath && Storage::disk('uploads')->exists($imagePath)) {
        Storage::disk('uploads')->delete($imagePath);

          }
}

}

