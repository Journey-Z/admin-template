<?php
namespace App\Modules\Dashboard\Presenters;
use App\Traits\TimeZone;

class TimeZonePresenter
{
    use TimeZone;

    /**
     * 用户当前时区
     *
     * @return mixed
     */
    public function user_TimeZone()
    {
        return $this->currentTimeZone();
    }

    /**
     * 格式话时间（时间戳or时间字符串）为年月日时分秒
     *
     * @param $date
     * @return mixed
     */
    public function user_FormatDateToYMDHMS($date)
    {
        return $this->formatDateToYMDHMS($date);
    }

}