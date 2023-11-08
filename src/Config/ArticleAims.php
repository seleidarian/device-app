<?php

namespace App\Config;

use App\Util\EnumToArray;

enum ArticleAims: int
{
    use EnumToArray;

    case No = 0;
    case Небо = 1;
    case Земля = 2;
    case Контрбатарейна = 3;
    case Зенiтна = 4;
}
