<?php

namespace App\Helpers;
class ImageHelper
{
    public static function convertImagePathToUrl($imagePath)
    {        
        $imageUrl = trim(str_replace('\\', '/', $imagePath), '/');
        return url('storage/' . $imageUrl);
    }
}
