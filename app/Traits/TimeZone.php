<?php

namespace App\Traits;
use Cookie;
use Config;
use Auth;

/**
 * Cookie值
 */
const g_COOKIE_TIMEZONE = 'timezone';

trait TimeZone
{
    /**
     * 获取当前登录用户设置的时区
     */
    protected function currentTimeZone(){
        $timezone = Cookie::get(g_COOKIE_TIMEZONE);
        if(!$timezone){
            return Config::get("app.view_tz");
        }
        return $timezone;
    }

    /**
     * 转换UTC时间为当前用户设置的时区时间
     *
     * @param $timestamp
     * @return string
     */
    public  function formatDateToYMDHMS($date)
    {
        if($date instanceof \Carbon\Carbon){
            $date->setTimezone($this->currentTimeZone())->toDateTimeString();
        }else if(is_int($date) && $date != 0){ //if the date value is timestamp
            $date = \Carbon\Carbon::createFromTimestamp($date,$this->currentTimeZone())->toDateTimeString();
        }else if(is_string($date) && $date != ''){
            $date = \Carbon\Carbon::parse($date,$this->currentTimeZone())->toDateTimeString();
        }
        return $date;
    }

    /**
     * 将字符串格式时间转成date
     *
     * @param $date_string
     * @return static
     */
    function convertDateStringToDate($date_string)
    {
        return \Carbon\Carbon::parse($date_string,$this->currentTimeZone());
    }

    /**
     * 转换UTC时间戳为当前用户设置的时区时间
     *
     * @param $timestamp
     * @return string
     */
    public  function convertDateSpToDate($timestamp)
    {
        if(!(int)$timestamp)return ''; //判断返回是否是有效的日期，剔除0000-00-00 00:00:00这样的日期
        return $date = \Carbon\Carbon::createFromTimestamp($timestamp,$this->currentTimeZone());
    }

}