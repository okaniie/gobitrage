<?php

namespace App\Support;

use App\Services\Cointelegraph\NewsLoader;

class News
{
    public static function getCoinTelegraphNews($count = 20)
    {
        $news = new NewsLoader();
        return $news->coinTelegraphNews($count);
    }
}
