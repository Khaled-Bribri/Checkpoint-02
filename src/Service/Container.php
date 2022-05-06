<?php

namespace App\Service;

class Container
{
    public const SMALL = 2;
    public const MEDIUM = 5;
    public const LARGE = 8;

    public function inbox(int $numberCake)
    {

            $reste = $numberCake;
            $large = 0;
            $medium = 0;
            $small = 0;
            $reste5 = 0;


        if ($numberCake % 8 === 0) {
            $large = $numberCake / 8;
            $reste = 0;
        } elseif ($numberCake % 8 != 0) {
            $reste = $numberCake % 8;
            $numberCake = ($numberCake - $reste) / 8;
        }

        if ($reste % 5 === 0) {
            $medium = $reste / 5;
            $reste = 0;
        } elseif ($reste % 5 != 0) {
            $reste5 = $reste % 5;
            $medium = ($reste - $reste5) / 5;
        }
        if ($reste5 % 2 === 0) {
            $small = $reste5 / 2;
            $reste5 = 0;
        } elseif ($reste5 % 2 != 0) {
            $reste2 = $reste5 % 2;
            $small = ($reste5 - $reste2) / 2;
        }


        return $large . "/" . $medium . "/" . $small;
    }
}
