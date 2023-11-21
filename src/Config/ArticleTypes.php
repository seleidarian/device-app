<?php

namespace App\Config;

use App\Util\EnumToArray;

enum ArticleTypes: int
{
    use EnumToArray;

    case BPLA = 2;
    case RLS = 1;
    case REB = 3;
}
