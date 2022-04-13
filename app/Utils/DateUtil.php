<?php
namespace App\Utils;

use DateTime;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;

class DateUtil
{
    /**
     * date time converter.
     *
     * @param string    datetime or date
     * @param string    date | datetime | time default date
     * @param array     optional params
     *
     * @return string   formatted datetime
     *
     */
    public static function dateTimeFormatter($datetime, $format_type = 'date', $options = [])
    {
        if(!$datetime || $datetime == '0000-00-00 00:00:00')
            return '-';
        $format = 'Y-m-d';
        $defaultOptions = [
            'date_separator' => '-',
            'time_separator' => ':'
        ];

        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );
        switch ($format_type) {
            case 'date' :
                $format = 'Y-m-d';
                break;
            case 'datetime' :
                $format = 'Y-m-d H:i';
                break;
            case 'time' :
                $format = 'H:i';
                break;
            default :
                $format = 'Y-m-d';
        }

        $replace = [
            '-' => $mergedOptions['date_separator'],
            ':' => $mergedOptions['time_separator']
        ];

        $format = str_replace(array_keys($replace), array_values($replace), $format);
        return date($format, strtotime($datetime));
    }

    public static function dateTimeNow($format_type = 'datetime', $options = [])
    {
        $timeStamp = Carbon::now();
        $timeStamp->setTimeZone('Asia/Tokyo');
        $now = $timeStamp->toDateTimeString();

        return DateUtil::dateTimeFormatter($now, $format_type, $options);
    }

    public static function isInPeriod($start, $end)
    {
        $return = false;
        $now = strtotime(now());
        $start = strtotime($start);
        $end = strtotime($end);

        if($now > $start && $now < $end) {
            $return = true;
        }

        return $return;
    }

    public static function isStart($start)
    {
        $return = false;
        $now = strtotime(now());
        $start = strtotime($start);

        if($now > $start) {
            $return = true;
        }

        return $return;
    }

    public static function isEnd($end)
    {
        $return = false;
        $now = strtotime(now());
        $end = strtotime($end);

        if($now > $end) {
            $return = true;
        }

        return $return;
    }

    public static function getRemaining($dateTime, $type = 'time')
    {
        $dateTime = \Carbon\Carbon::now()->diffInHours($dateTime, false);

        return \Carbon\CarbonInterval::hours($dateTime)->cascade()->forHumans();
    }
}
