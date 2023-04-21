<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * @return null|string - Relative path of uploaded image
     */
    public static function save(?UploadedFile $img, ?string $dir = 'uploaded', ?string $name = ''): ?string
    {
        if ($img) {
            $name = ($name ? $name : Str::random(6)) . '.' . $img->getClientOriginalExtension();
            $img->move(public_path($dir), $name)->getPathname();

            return $dir . '/' . $name;
        }
        return null;
    }
}
