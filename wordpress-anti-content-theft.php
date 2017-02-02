<?php

/**
 * @package Stop_WordPress_Fake_Bots
 * @version 0.1
 */
/*
Plugin Name: Stop WordPress Fake Bots
Plugin URI: https://github.com/areebmajeed/wordpress-anti-content-theft
Description: Tired of content theft? Use this simple plugin to protect your content, and put fake bots away from the scene.
Author: Areeb
Version: 0.1
Author URI: http://areebmajeed.me/
*/

function SWFB_get_IP() {
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (SWFB_validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && SWFB_validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && SWFB_validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && SWFB_validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && SWFB_validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}


function SWFB_validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}

function strposa($haystack, $needle, $offset=0) {

if(!is_array($needle)) $needle = array($needle);
foreach($needle as $query) {
if(strpos($haystack, $query, $offset) !== false) {
return true;
}
return false;
}

}

function initSWFB() {
    
$ip_addr = SWFB_get_IP();
$crawlers = array("googlebot","bingbot","yandexbot","slurp");
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$bad = true;

if(strposa(strtolower($user_agent),$crawlers) == TRUE) {

if(strpos(strtolower($user_agent),"googlebot")) {
    
$validate = gethostbyaddr($ip_addr);
$second_validate = dns_get_record($validate);
    
if($second_validate[0]['ip'] == $ip_addr && preg_match("/^(googlebot.com|google.com)/i",$validate)) {
    
$bad = false;
    
} 

}

if(strpos(strtolower($user_agent),"bingbot")) {
    
$validate = gethostbyaddr($ip_addr);
$second_validate = dns_get_record($validate);
    
if($second_validate[0]['ip'] == $ip_addr && preg_match("/^(bing.com|msn.com)/i",$validate)) {
    
$bad = false;
    
} 

}

if(strpos(strtolower($user_agent),"yandexbot")) {
    
$validate = gethostbyaddr($ip_addr);
$second_validate = dns_get_record($validate);
    
if($second_validate[0]['ip'] == $ip_addr && preg_match("/^(yandex.net|yandex.ru|yandex.com)/i",$validate)) {
    
$bad = false;
    
} 

}

if(strpos(strtolower($user_agent),"slurp")) {
    
$validate = gethostbyaddr($ip_addr);
$second_validate = dns_get_record($validate);
    
if($second_validate[0]['ip'] == $ip_addr && preg_match("/^(crawl.yahoo.com|crawl.yahoo.net)/i",$validate)) {
    
$bad = false;
    
} 

}

if(strpos(strtolower($user_agent),"baiduspider")) {
    
$validate = gethostbyaddr($ip_addr);
$second_validate = dns_get_record($validate);
    
if($second_validate[0]['ip'] == $ip_addr && preg_match("/^(baidu.com|baidu.jp)/i",$validate)) {
    
$bad = false;
    
} 

}

if(strpos(strtolower($user_agent),"DuckDuckBot")) {
    
if(in_array($ip_addr,array("72.94.249.34","72.94.249.35","72.94.249.36","72.94.249.37","72.94.249.38"))) {
    
$bad = false;
    
} 

}

} else {
    
$bad = false;
    
}

$bots_array = array('alexibot', 'aqua_products', 'b2w', 'backdoorbot', 'blackhole', 'blowfish', 'bookmarksearchtool', 'botalot', 'builtbottough', 'bullseye', 'bunnyslippers', 'cegbfeieh', 'cheesebot', 'cherrypicker', 'cherrypickerelite', 'cherrypickerse', 'copernic', 'copyrightcheck', 'cosmos', 'crescent', 'crescentinternettoolpakhttpolecontrolv', 'dittospyder', 'dumbot', 'emailcollector', 'emailsiphon', 'emailwolf', 'enterprise_search', 'erocrawler', 'es', 'extractorpro', 'fairadclient', 'flamingattackbot', 'foobot', 'gaisbot', 'getright', 'grub', 'grub-client', 'harvest', 'hatenaantenna', 'hloader', 'httplib', 'humanlinks', 'ia_archiver', 'ia_archiver', 'infonavirobot', 'iron33', 'jennybot', 'kenjinspider', 'keyworddensity', 'larbin', 'lexibot', 'libweb/clshttp', 'libweb/clshttpuser-agent:asterias', 'linkextractorpro', 'linkscan', 'kenjinspider', 'linkwalker', 'lnspiderguy', 'lwp-trivial', 'matahari', 'microsofturlcontrol', 'microsofturlcontrol-5.01.4511', 'microsofturlcontrol-6.00.8169', 'miixpc', 'misterpix', 'moget', 'morfeus', 'msiecrawler', 'naver', 'netants', 'netmechanic', 'nicerspro', 'offlineexplorer', 'openbot', 'openfind', 'openfinddatagathere', 'oracleultrasearch', 'perman', 'propowerbot', 'prowebwalker', 'psbot', 'python-urllib', 'querynmetasearch', 'radiationretriever', 'repomonkey', 'repomonkeybait', 'rma', 'searchpreview', 'sitesnagger', 'sootle', 'spankbot', 'spanner', 'suzuran', 'szukacz', 'teleport', 'teleportpro', 'telesoft', 'theintraformant', 'thenomad', 'tighttwatbot', 'titan', 'tocrawl/urldispatcher', 'true_robot','turingos', 'urlcontrol', 'url_spider_pro', 'urlywarning', 'vci', 'vciwebviewervciwebviewerwin32', 'webimagecollector', 'webauto', 'webbandit', 'webbandit', 'webcopier', 'webenhancer', 'webmasterworldextractor', 'webmasterworldforumbot', 'websauger', 'websitequester', 'websterpro', 'webstripper', 'webzip', 'www-collector-e', 'xenu', 'zeus', 'zeus32297websterprov2.9win32', 'zeuslinkscout', 'zmeu', 'baidubot','fhscan','acunetix','zyborg');

if(strposa(strtolower($user_agent),$bots_array) == true) {

$bad = true;

}

if($bad == true) {
    
exit();
    
}

}

add_action('wp_loaded','initSWFB');

?>
