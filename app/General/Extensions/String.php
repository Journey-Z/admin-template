<?php
/**
 * Created by sms.
 * User: Bruce.He
 * Date: 15/11/17
 * Time: 上午1:48
 */

/**
 * 判断是否是字符串，空的也返回false
 * @param $str
 * @return bool
 */
function isvalid_string($str){
    if(!isset($str) || empty($str)){
        return false;
    }
   return true;
}

/**
 *当原字符串没设置值时，返回替换字符串
 *
 * @param $origin
 * @param $replace
 * @return mixed
 */
function str_replace_empty($origin,$replace)
{
    if(!isset($origin) || (empty($origin)) && !empty($replace)){
        return $replace;
    }
    return $origin;
}

/**
 * 检查字字符串是否存在，不在存在就返回空字符串
 * @param $str
 * @return mixed
 */
function str_checkreplace($str){
   return str_replace_empty($str,'');
}

/**
 * 解析url的所有参数放到数组里
 * @param $url
 * @return array
 */
function parametersWithURl($url)
{
    if(isvalid_string($url)){
        $queryString = '';
        $flagPos = strpos($url,'?');
        if($flagPos){
            //获取?后面的部分，例如k1=v1&k2=v2部分
            $queryString = substr($url,$flagPos+1);
        }
        if(isvalid_string($queryString)){
            $queryParts = explode('&',$queryString); //采取&分割开
            $parameters = [];
            foreach($queryParts as $p){
                $items = explode('=',$p);
                if(is_array($items)&&count($items)==2){
                    $parameters[$items[0]]=$items[1];
                }
            }
            return $parameters;
        }
    }
    return [];
}

/**
 * 从url中获取key的值，例如http://demo.com?key=value&k1=v1，获取k1的值
 * @param $url
 * @param $key
 * @return string
 */
function parameterWithURl($url,$key){
    if(isvalid_string($key)){
        $parameters = parametersWithURl($url);
        if(array_has($parameters,$key)){
            return $parameters[$key];
        }
    }
    return '';
}

/**
 * format options
 * @param $options
 * @return string
 */
function formatOptions($options){
    $optionString = '';
    if ($options) {
        for ($index = 0; $index < count($options); $index++) {
            $option = (object)$options[$index];
            if ($index == 0) {
                $optionString = $option->option_name . ' ' . $option->option_value;
            } else {
                $optionString = $optionString . '  ' . $option->option_name . ' ' . $option->option_value;
            }
        }
    }
    return $optionString;
}

/**
 * round up value, e.g: 12.44->13 12.55->13
 * @param $value
 * @param $places
 * @return float
 */
function round_up($value, $places)
{
    $mult = pow(10, abs($places));
    return $places < 0 ?
        ceil($value / $mult) * $mult :
        ceil($value * $mult) / $mult;
}

/**
 * Check email is valid
 *
 * @param $email
 * @return bool
 */
function is_email($email)
{
    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
    if (preg_match( $pattern,$email)) return true;
    return false;
}

/**
 * 获取当前日期
 */
function getCurrentDate($split = "" ,  $isTime = 0)
{
    $nowTime = getdate();
    $year = $nowTime["year"];
    $mon = $nowTime["mon"];
    $mday = $nowTime["mday"];
    $hours = $nowTime["hours"];
    $minutes = $nowTime["minutes"];
    $seconds = $nowTime["seconds"];
    $curDate =  $year.$split.($mon<10 ?"0".$mon:$mon).$split.($mday<10 ?"0".$mday:$mday);
   if($isTime){
       $curDate = $curDate."".($hours<10 ?"0".$hours:$hours)."".
           ($minutes<10 ?"0".$minutes:$minutes)."".($seconds<10 ?"0".$seconds:$seconds);
   }
    return $curDate;
}

