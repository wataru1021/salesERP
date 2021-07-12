<?php


namespace App\Enums;


use BenSampo\Enum\Enum;

final class TimeLine extends  Enum
{
    const HandMadeTimeLine = 0;
    const Today = 1;
    const Yesterday = 2;
    const Last7Days = 3;
    const Last30Days = 4;
}
