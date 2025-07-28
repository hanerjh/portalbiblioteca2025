<?php

namespace App\Helpers;

class ColorHelpers
{
    public static function generateTagStyles($texto = null)
    {
        // Hashear la etiqueta
       // $hash = md5($tag);

          $hash = $texto
            ? substr(md5($texto), 0, 6)
            : substr(str_shuffle('ABCDEF0123456789'), 0, 6);

        $r = hexdec(substr($hash, 0, 2));
        $g = hexdec(substr($hash, 2, 2));
        $b = hexdec(substr($hash, 4, 2));

        // Fondo claro (mezclado con blanco)
        $bgR = intval(($r + 255) / 2);
        $bgG = intval(($g + 255) / 2);
        $bgB = intval(($b + 255) / 2);

        // Convertir a strings CSS
        $backgroundColor = "rgb($bgR, $bgG, $bgB)";
        $textColor = "rgb($r, $g, $b)";

        return [
            'fondo' => $backgroundColor,
            'texto' => $textColor,
        ];
    }
}
