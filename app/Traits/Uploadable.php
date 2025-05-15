<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Uploadable
{
    public function upload($file, $directory)
    {
        if ($file) {
            $name = Str::ulid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path($directory);

            // Create the directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $name);
            return $name;
        }

        return null;
    }
}
