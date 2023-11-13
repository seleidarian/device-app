<?php

namespace App\Config;

use App\Util\EnumToArray;

enum ArticleAims: int
{
    use EnumToArray;

    case Небо = 1;
    case Земля = 2;
    case Контрбатарейна = 3;
    case Зенiтна = 4;
    case Навігація = 5;
    case Ударний  = 6;
    case Розвідувальний = 7;
    case Камікадзе = 8;
    case FPV = 9;
}
