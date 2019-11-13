<?php

$Mobile = isMobile();

if($Mobile){
	$line = $_GET['line'];
	$Whasapp = $_GET['phone'];
	if($line){
		$device_type = get_device_type();
		if($device_type != "android"){
			echo '<script language="javascript">location.href="http://line.naver.jp/ti/p/'.$line.'"</script>';
		}else{
			echo '<h1><font face="verdana">正在打开line</font></h1>';
			echo '<script type="text/javascript">window.location.href = "intent://ti/p/'.$line.'#Intent;scheme=line;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=jp.naver.line.android;end";</script>';
		}
	} 
	elseif($Whasapp){
		$WhasappText = $_GET['text'];
		echo '<h1><font face="verdana">正在打开Whatsapp</font></h1>';
		echo '<script type="text/javascript">window.location.href = "whatsapp://send?text='.$WhasappText.'&phone='.$Whasapp.'"</script>';
	}
}else{
    echo " ";
}


function isMobile()
{
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    return true;
 
    if (isset ($_SERVER['HTTP_VIA']))
    {
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    }
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            return true;
    }
    if (isset ($_SERVER['HTTP_ACCEPT']))
    {
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        }
    }
            return false;
}

function get_device_type()
{
 $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
 $type = 'other';
 if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
{
 $type = 'ios';
 } 
 if(strpos($agent, 'android'))
{
 $type = 'android';
 }
 return $type;
}


?>


