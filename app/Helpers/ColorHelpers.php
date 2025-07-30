<?php

namespace App\Helpers;

class ColorHelpers
{
    public static function generateTagStyles($texto = null)
    {
       
                 $hash = md5($texto ?? uniqid());

                // Dispersar los canales RGB para más variedad
                $r = hexdec(substr($hash, 0, 2));
                $g = hexdec(substr($hash, 6, 2));
                $b = hexdec(substr($hash, 12, 2));

                // Mezcla con blanco (fondo pastel pero con más color)
                $mezclaFondo = 0.75;
                $rFondo = (int)($r * $mezclaFondo + 255 * (1 - $mezclaFondo));
                $gFondo = (int)($g * $mezclaFondo + 255 * (1 - $mezclaFondo));
                $bFondo = (int)($b * $mezclaFondo + 255 * (1 - $mezclaFondo));

                $backgroundColor = sprintf("#%02X%02X%02X", $rFondo, $gFondo, $bFondo);

                // Oscurecer para texto (más contrastado con el fondo claro)
                $oscurecer = 0.5;
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
