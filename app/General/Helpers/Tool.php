<?php
if (!function_exists('validate_heading')) {
    /**
     * 验证表格头
     * @param \Maatwebsite\Excel\Readers\LaravelExcelReader $reader
     * @param array $heading
     * @return array
     */
    function validate_heading(\Maatwebsite\Excel\Readers\LaravelExcelReader $reader, array $heading)
    {
        $reader = clone $reader; // 这里的clone非常重要
        try {
            $header_line = $reader->select($heading)->first();
            if (!$header_line) {
                return array('status' => false, 'errMsg' => '表格信息为空或者无效');
            }
            $header_line = $header_line->toArray();
        } catch (Exception $e) {
            return array('status' => false, 'errMsg' => $e->getMessage());
        }

        foreach ($heading as $key) {
            if (!array_key_exists($key, $header_line)) {
                return array("status" => false, 'errMsg' => "表格缺少头信息：" . $key);
            }
        }
        return ['status' => true];
    }
}

    /**
     * get browser information
     * @return array
     */
    function getBrowser()
    {
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
        $ub = "";
        try{
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
        }catch (Exception $e){
            $u_agent = 'Unknown';
            Log::error($e->getMessage());
        }

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        try{
            // see how many we have
            $i = count($matches['browser']);
            if ($i != 1) {
                //we will have two since we are not using 'other' argument yet
                //see if version is before or after the name
                if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                    $version= $matches['version'][0];
                }
                else {
                    $version= $matches['version'][1];
                }
            }
            else {
                $version= $matches['version'][0];
            }
        }catch (Exception $e){
            $version='';
            Log::error($e->getMessage());
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname.'_'.$version,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }

    function isHttps()
    {
        if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
        {
            return TRUE;
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        {
            return TRUE;
        }
        elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
        {
            return TRUE;
        }
        return FALSE;
    }

    function cdnUrl($url,$is_https=false)
    {
        if(!$url || empty($url))return $url;
        $cnd_url = env('SOURCE_CND_URL','');
        $asset_cnd_url = env('ASSET_CND_URL','');
        if(!starts_with($url, 'http') && !starts_with($url, 'https')){
            $url = ($is_https || isHttps())?secure_url($url):url($url);
        }
        $cdn_infos=[
            "www.interfocus.org"=>$asset_cnd_url,
            "www.patpat.com"=>$asset_cnd_url,
            "patpatdev.s3-us-west-1.amazonaws.com"=>$cnd_url,
            "patpatasset.s3.amazonaws.com"=>$asset_cnd_url,
            "patpatdev.s3.amazonaws.com"=>$cnd_url,
            "s3-us-west-1.amazonaws.com"=>$cnd_url,

        ];
        foreach (array_keys($cdn_infos) as $index=>$origin_host){
            if(str_contains($url,$origin_host) && !empty($cdn_infos[$origin_host])){
                $url=str_replace($origin_host,$cdn_infos[$origin_host],$url);
                break;
            }
        }
        return $url;
    }

    /**
     *
     */
  function getLogisticsCirculation($contry, $mode, $total)
  {


  }

/**
 *
 * 数据库UTC的时区转换为用户本地时区
 *
 * @param $time
 * @return \Carbon\Carbon
 */
  function utcTimeToUserTimeZone($time){
      $user = Auth::user();
      $timezone = $user->timezone;
      $carbonAt = new \Carbon\Carbon($time, "UTC");
      $carbonAt->setTimezone($timezone);
      return $carbonAt;
  }

/**
 * 生成随机的字符串
 */
function createRandStr($count=12)
{
    $str = '23456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $word = '';
    for ($i=0; $i < $count; $i++) {
        $word .= $str[mt_rand(0,strlen($str)-1)];
    }
    return $word;
}

/**
 * 生成加密口令
 * @return string
 */
function getAccessToken()
{
    $str = createRandStr(32);
    return sha1($str.time());
}

/**
 * 签名加密方法
 * @param $params
 * @return bool
 */
function validateSign($params)
{
    if($params['sign']) unset($params['sign']);
    if($params['access_sign']) unset($params['access_sign']);
    ksort($params);
    $str = '';
    foreach ($params as $key => $val){
        if(is_array($val)) {
            $str .= "{$key}=".json_encode($val);
        }else{
            $str .= "{$key}={$val}";
        }
    }
    return sha1($str);
}

function secure_route($route_name,$parameters = [])
{
    $is_https=env('SELLER_HTTPS',false);
    if($is_https){
        return httpToHttps(route($route_name,$parameters));
    }else{
        return route($route_name,$parameters);
    }
}

function httpToHttps($url)
{
    return preg_replace("/^http:/i", "https:", $url);
}