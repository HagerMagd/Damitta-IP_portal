<?php
namespace App\Utlis;
use Illuminate\Support\Str;

class FileManager
{
    public static function upload($file, $folder)
    {
        $file_name=Str::uuid().'.'.$file->getClientOriginalExtension();
        $path= $file->storeAs($folder,$file_name);
        return $path;
    }

    public static function delete($path)
    {

    }

    public static function hash($file)
    {

    }
}


?>