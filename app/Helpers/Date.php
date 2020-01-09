<?php
/**
 * Created by: PhpStorm.
 * UserCreated: Nam Nguyen
 * DateCreated: 10/12/19 20:11
 */

namespace App\Helpers;

use Carbon\Carbon;

class Date
{
    /**
     * @param string $stringDate
     * @return string
     * @throws \Exception
     */
    static function convertToUTC(string $stringDate)
    {
        // @TODO: Convert date to UTC Ex. Wed, 11 Jun 2014 09:00:00 -0400 to 2014-06-11 13:00:00
        return (new Carbon($stringDate))->format('Y-m-d H:i:s');
    }
}
