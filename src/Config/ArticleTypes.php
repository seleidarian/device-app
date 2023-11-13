<?php

namespace App\Config;

use App\Util\EnumToArray;

enum ArticleTypes: string
{
    use EnumToArray;

    case RLS = '1';
    case BPLA = '2';
    case REB = '3';
}
