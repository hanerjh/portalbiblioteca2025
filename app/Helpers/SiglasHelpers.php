<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class SiglasHelpers
{
    public static function generateSiglasTag($texto)
    {
       /*  return collect(explode(' ', $texto))
            ->filter()
            ->map(fn($palabra) => strtoupper($palabra[0]))
            ->implode(''); */

            $palabras = collect(explode(' ', trim($texto)))
             ->filter();

            if ($palabras->count() === 1) {
                return ucfirst(substr($palabras->first(), 0, 3));
                
            }

            return $palabras
                ->map(fn($palabra) => strtoupper($palabra[0]))
                ->implode('');
                
    }
}
