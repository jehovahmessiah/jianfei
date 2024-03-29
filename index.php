<?php


require_once 'autoload.php';

use MaxMind\Db\Reader;

$ipAddress = get_real_ip();

$databaseFile = 'GeoLite2-Country.mmdb';

$reader = new Reader($databaseFile);

$s = $reader->get($ipAddress);

$s_code = $s["country"]["iso_code"];

if($s_code !=="TH" && $s_code !=="MY" && $s_code !=="SG"){
         require_once "shy.html";
      }else{
        //   echo "我是推广页";
         echo '<script language="javascript">location.href="jf/index.html"</script>';
      }


function get_real_ip()

{

    $ip=FALSE;

    //客户端IP 或 NONE 

    if(!empty($_SERVER["HTTP_CLIENT_IP"])){

        $ip = $_SERVER["HTTP_CLIENT_IP"];

    }

    //多重代理服务器下的客户端真实IP地址（可能伪造）,如果没有使用代理，此字段为空

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);

        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }

        for ($i = 0; $i < count($ips); $i++) {

            if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {

                $ip = $ips[$i];

                break;

            }

        }

    }

    //客户端IP 或 (最后一个)代理服务器 IP 

    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);

}

?>