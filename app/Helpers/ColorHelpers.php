<?php

namespace App\Helpers;

class ColorHelpers
{
    public static function generateTagStyles($texto = null)
    {
        // Hashear y sacar valores RGB dispersos del hash
        $hash = md5($texto ?? uniqid());

        $r = hexdec(substr($hash, 0, 2));
        $g = hexdec(substr($hash, 8, 2));
        $b = hexdec(substr($hash, 16, 2));

        // Mezcla con blanco (suavizado pastel)
        $mezclaFondo = 0.55;

        // Aplicar "matiz suave" → mezcla con blanco (color pastel)
            $r = (int)($r * $mezclaFondo + 255 * (1 - $mezclaFondo));
            $g = (int) ($g * $mezclaFondo + 255 * (1 - $mezclaFondo));
            $b = (int)($b * $mezclaFondo + 255 * (1 - $mezclaFondo));

            $backgroundColor = sprintf("#%02X%02X%02X", $r, $g, $b);

            // Luminancia para texto legible
            $oscurecer = 0.4; // entre 0 (negro) y 1 (sin cambio)
            $rTexto = (int)($r * $oscurecer);
            $gTexto = (int)($g * $oscurecer);
            $bTexto = (int)($b * $oscurecer);

            $textColor = sprintf("#%02X%02X%02X", $rTexto, $gTexto, $bTexto);


        return [
            'fondo' => $backgroundColor,
            'texto' => $textColor,
        ];
    }
}
