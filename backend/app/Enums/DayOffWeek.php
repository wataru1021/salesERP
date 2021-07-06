<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class DayOffWeek extends Enum
{
    const MONDAY =   'Monday';
    const TUESDAY =   'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY = 'Thursday';
    const FRIDAY = 'Friday';
    const SATURDAY = 'Saturday';
    const SUNDAY = 'Sunday';

    public static function getThJp($value): string
    {
        switch ($value) {
            case self::MONDAY:
                return '月';
                break;

            case self::TUESDAY:
                return '火';
                break;

            case self::WEDNESDAY:
                return '水';
                break;

            case self::THURSDAY:
                return '木';
                break;

            case self::FRIDAY:
                return '金';
                break;

            case self::SATURDAY:
                return '土';
                break;

            case self::SUNDAY:
                return '日';
                break;

            default:
                break;
        }
    }
}
