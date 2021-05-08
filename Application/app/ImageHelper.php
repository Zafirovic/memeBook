<?php

namespace App;

use Image;

final class ImageHelper 
{
    public static function CreateImage($requestImage, $img_path)
    {
        //convert to base64 and fill image file with data
        $img = str_replace('data:image/png;base64,', '', $requestImage);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        $fileName = 'photo.png';
        file_put_contents($fileName, $fileData);

        //create image based on filled file
        $createdImg = Image::make(file_get_contents($fileName));
        $img_name = "/" . time() . ".png";
        $path = public_path($img_path);
        $createdImg->save($path . $img_name);

        return $img_name;
    }
}