<?php

namespace App\Http\Util;

use DateTime;

/**
 * Class DateUtil
 * @package App\Http\Util
 * @author lucasrafael
 */
class DateUtil
{
    /**
     * Converte "string" do formato 'd/m/Y' (Europeu) para 'Y-m-d' (ISO).
     * @param $strDate
     * @return string|null
     * @throws \Exception
     */
    public static function transformEurDateFormatToIso($strDate)
    {
        if ($strDate) {
            return (new DateTime(str_replace('/', '-', $strDate)))->format('Y-m-d');
        }
        return null;
    }

    /**
     * Converte "string" do formato 'Y-m-d' (ISO) para 'd/m/Y' (Europeu).
     * @param $strDate
     * @return string|null
     * @throws \Exception
     */
    public static function transformIsoDateFormatToEur($strDate)
    {
        if ($strDate) {
            return (new DateTime($strDate))->format('d/m/Y');
        }
        return null;
    }

}
