<?php

namespace App\Helpers;

class Common
{
    // Done test
    public static function getColorPriority($priority)
    {
        $color = '';
        switch($priority) {
            case 1:
                $color = '#E73D35';
                break;
            case 2:
                $color = '#DFF316';
                break;
            case 3:
                $color = '#16A6F3';
                break;
            case 4:
                $color = '#BA16F3';
                break;
        }
        return $color;
    }
}
