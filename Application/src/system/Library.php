<?php
define('Application', PATH . DIRECTORY_SEPARATOR . "Application");

define('System', Application . DIRECTORY_SEPARATOR . "src/system");

define('writable', Application . DIRECTORY_SEPARATOR . "src/writable");

define('Storage', PATH . DIRECTORY_SEPARATOR . "Storage");

define('Views', Application . DIRECTORY_SEPARATOR . "Views");

define('Controller', Application . DIRECTORY_SEPARATOR . "Controllers");


/******************-Function-******************/
if (! function_exists('env')) {
    function env(string $key, $default = null)
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false) {
            return $default;
        }
        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'empty':
                return '';
            case 'null':
                return null;
        }
        return $value;
    }
}
if(!function_exists('binary_encode')){
	function binary_encode(string $contents){ #$contents =• file_get_contents(image.png or style.css => base64_encode by string)
		return base64_encode(gzcompress($contents));
	}
}
if(!function_exists('binary_decode')){
	function binary_decode(string $contents){ #$contents =• file_get_contents(base64_encode by string => image.png or style.css)
		return gzuncompress(base64_decode($contents));
	}
}
if(!function_exists("input_encode")){
	function input_encode($str) {
    	// Remove acentos
    	$str = remove_acentos($str);
        // Substitui caracteres reservados
        $str = str_replace(';', '-', $str);
        $str = str_replace('?', '-', $str);
        $str = str_replace(':', '-', $str);
        $str = str_replace('@', '-', $str);
        $str = str_replace('=', '-', $str);
        $str = str_replace('&', '-', $str);
        // Caracteres adicionais
        $str = str_replace('(', '-', $str);
        $str = str_replace(')', '-', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('`', '', $str);
    	$str = replace_double('-', $str);
    	return $str;
	}
}

if(!function_exists('Storage')){
	function Storage(string $load){
		return "?load=" . $load;
	}
}

if(!function_exists('Extension')){
	function Extension(){
		return [
            'hqx' => 'application/x-binhex40',
            'cpt' => 'application/mac-compactpro',
            'csv' => 'text/csv',
            'bin' => 'application/octet-stream',
            'dms' => 'application/octet-stream',
            'lha' => 'application/octet-stream',
            'lzh' => 'application/octet-stream',
            'exe' => 'application/x-msdownload',
            'class' => 'application/octet-stream',
            'psd'   => 'application/x-photoshop',
            'so'  => 'application/octet-stream',
            'sea' => 'application/octet-stream',
            'dll' => 'application/octet-stream',
            'oda' => 'application/oda',
            'pdf' => 'application/pdf',
            'ai' => 'application/pdf',
            'eps'  => 'application/postscript',
            'ps'   => 'application/postscript',
            'smi'  => 'application/smil',
            'smil' => 'application/smil',
            'mif'  => 'application/vnd.mif',
            'xls'  => 'application/xls',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'wbxml' => 'application/wbxml',
            'wmlc'  => 'application/wmlc',
            'dcr'   => 'application/x-director',
            'dir'   => 'application/x-director',
            'dxr'   => 'application/x-director',
            'dvi'   => 'application/x-dvi',
            'gtar'  => 'application/x-gtar',
            'gz'    => 'application/x-gzip',
            'gzip'  => 'application/x-gzip',
            'php'   => 'application/php',
            'php4'  => 'application/x-httpd-php',
            'php3'  => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps'  => 'application/x-httpd-php-source',
            'js'    => 'application/x-javascript',
            'swf' => 'application/x-shockwave-flash',
            'sit' => 'application/x-stuffit',
            'tar' => 'application/x-tar',
            'tgz' => 'application/x-tar',
            'z'     => 'application/x-compress',
            'xhtml' => 'application/xhtml+xml',
            'xht'   => 'application/xhtml+xml',
            'zip'   => 'application/zip',
            'rar' => 'application/rar',
            'mid'  => 'audio/midi',
            'midi' => 'audio/midi',
            'mpga' => 'audio/mpeg',
            'mp2'  => 'audio/mpeg',
            'mp3'  => 'audio/mp3',
            'aif' => 'audio/aiff',
            'aiff' => 'audio/aiff',
            'aifc' => 'audio/x-aiff',
            'ram'  => 'audio/x-pn-realaudio',
            'rm'   => 'audio/x-pn-realaudio',
            'rpm'  => 'audio/x-pn-realaudio-plugin',
            'ra'   => 'audio/x-realaudio',
            'rv'   => 'video/vnd.rn-realvideo',
            'wav'  => 'audio/wave',
            'bmp' => 'image/bmp',
            'gif' => 'image/gif',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpe' => 'image/jpeg',
            'jp2' => 'image/jp2',
            'j2k' => 'image/jp2',
            'jpf' => 'image/jp2',
            'jpg2' => 'image/jp2',
            'jpx' => 'image/jp2',
            'jpm' => 'image/jp2',
            'mj2' => 'image/jp2',
            'mjp2' => 'image/jp2',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'tif'  => 'image/tiff',
            'tiff' => 'image/tiff',
            'css'  => 'text/css',
            'html' => 'text/html',
            'htm' => 'text/html',
            'shtml' => 'text/html',
            'txt'  => 'text/plain',
            'text' => 'text/plain',
            'log'  => 'text/x-log',
            'rtx' => 'text/richtext',
            'rtf' => 'text/rtf',
            'xml' => 'application/xml',
            'xsl' => 'application/xml',
            'mpeg' => 'video/mpeg',
            'mpg'  => 'video/mpeg',
            'mpe'  => 'video/mpeg',
            'qt'   => 'video/quicktime',
            'mov'  => 'video/quicktime',
            'avi'  => 'video/avi',
            'movie' => 'video/x-sgi-movie',
            'doc'   => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'dot' => 'application/msword',
            'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
            'word' => 'application/msword',
            'xl'   => 'application/excel',
            'eml'  => 'message/rfc822',
            'json' => 'application/json',
            'pem' => 'application/octet-stream',
            'p10' => 'application/x-pkcs10',
            'p12' => 'application/x-pkcs12',
            'p7a' => 'application/x-pkcs7-signature',
            'p7c' => 'application/pkcs7-mime',
            'p7m' => 'application/pkcs7-mime',
            'p7r' => 'application/x-pkcs7-certreqresp',
            'p7s' => 'application/pkcs7-signature',
            'crt' => 'application/x-x509-ca-cert',
            'crl' => 'application/pkix-crl',
            'der' => 'application/x-x509-ca-cert',
            'kdb' => 'application/octet-stream',
            'pgp' => 'application/pgp',
            'gpg' => 'application/gpg-keys',
            'sst' => 'application/octet-stream',
            'csr' => 'application/octet-stream',
            'rsa' => 'application/x-pkcs7',
            'cer' => 'application/pkix-cert',
            '3g2' => 'video/3gpp2',
            '3gp' => 'video/3gp',
            'mp4' => 'video/mp4',
            'm4a' => 'audio/x-m4a',
            'f4v' => 'video/x-f4v',
            'flv'  => 'video/x-flv',
            'webm' => 'video/webm',
            'aac'  => 'audio/x-acc',
            'm4u'  => 'application/vnd.mpegurl',
            'm3u'  => 'text/plain',
            'xspf' => 'application/xspf+xml',
            'vlc'  => 'application/videolan',
            'wmv'  => 'video/x-ms-wmv',
            'au'   => 'audio/x-au',
            'ac3'  => 'audio/ac3',
            'flac' => 'audio/x-flac',
            'ogg'  => 'application/ogg',
            'kmz' => 'application/vnd.google-earth.kmz',
            'kml' => 'application/vnd.google-earth.kml+xml',
            'ics'  => 'text/calendar',
            'ical' => 'text/calendar',
            'zsh'  => 'text/x-scriptzsh',
            '7zip' => 'application/zip',
            'cdr' => 'application/cdr',
            'wma' => 'audio/x-ms-wma',
            'jar' => 'application/java-archive',
            'svg' => 'image/svg',
            'vcf' => 'text/x-vcard',
            'srt' => 'text/srt',
            'vtt' => 'text/vtt',
            'ico' => 'image/x-ico',
            'stl' => 'application/sla'
        ];
	}
}

/***************** library *****************/
function replace_double($sub,$str){
    $out=str_replace($sub.$sub,$sub,$str);
    while ( strlen($out) != strlen($str) ){
        $str=$out;
        $out=str_replace($sub.$sub,$sub,$str);
    }
    return $out;
}

function contains($search, $data){
        return strpos($data, $search) !== false;
}

function remove_acentos($string) {
    if ( !preg_match('/[\x80-\xff]/', $string) ) return $string;
    $chars = array(
    // Decompositions for Latin-1 Supplement
    chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
    chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
    chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
    chr(195).chr(135) => 'C', chr(195).chr(136) => 'E',
    chr(195).chr(137) => 'E', chr(195).chr(138) => 'E',
    chr(195).chr(139) => 'E', chr(195).chr(140) => 'I',
    chr(195).chr(141) => 'I', chr(195).chr(142) => 'I',
    chr(195).chr(143) => 'I', chr(195).chr(145) => 'N',
    chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
    chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
    chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
    chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
    chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
    chr(195).chr(159) => 's', chr(195).chr(160) => 'a',
    chr(195).chr(161) => 'a', chr(195).chr(162) => 'a',
    chr(195).chr(163) => 'a', chr(195).chr(164) => 'a',
    chr(195).chr(165) => 'a', chr(195).chr(167) => 'c',
    chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
    chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
    chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
    chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
    chr(195).chr(177) => 'n', chr(195).chr(178) => 'o',
    chr(195).chr(179) => 'o', chr(195).chr(180) => 'o',
    chr(195).chr(181) => 'o', chr(195).chr(182) => 'o',
    chr(195).chr(182) => 'o', chr(195).chr(185) => 'u',
    chr(195).chr(186) => 'u', chr(195).chr(187) => 'u',
    chr(195).chr(188) => 'u', chr(195).chr(189) => 'y',
    chr(195).chr(191) => 'y',
    // Decompositions for Latin Extended-A
    chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
    chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
    chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
    chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
    chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
    chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
    chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
    chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
    chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
    chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
    chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
    chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
    chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
    chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
    chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
    chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
    chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
    chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
    chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
    chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
    chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
    chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
    chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
    chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
    chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
    chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
    chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
    chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
    chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
    chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
    chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
    chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
    chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
    chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
    chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
    chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
    chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
    chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
    chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
    chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
    chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
    chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
    chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
    chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
    chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
    chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
    chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
    chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
    chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
    chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
    chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
    chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
    chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
    chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
    chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
    chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
    chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
    chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
    chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
    chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
    chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
    chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
    chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
    chr(197).chr(190) => 'z', chr(197).chr(191) => 's'
    );
    $string = strtr($string, $chars);
    return $string;
}
function str_strip($str,$valid_chars){
    $out = "";
    for ($i=0;$i<mb_strlen($str);$i++){
        $mb_char = mb_substr($str,$i,1);
        if (mb_strpos($valid_chars,$mb_char) !== false){
            $out .= $mb_char;
        }
    }
    return $out;
}

function getBaseUrl() {
	
		$isHttps = isHttps();
		list($host) = explode(':', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost'), 2);
		$url = ($isHttps ? 'https' : 'http').'://'.$host;
		$url .= ':' . getServerPort() . '/';
	return $url;
}
function isHttps() {
	return (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false
			|| isset($_SERVER['HTTP_X_FORWARDED_PROTOCOL']) && $_SERVER['HTTP_X_FORWARDED_PROTOCOL'] == 'https'
			|| isset($_SERVER['HTTP_X_REMOTE_PROTO']) && $_SERVER['HTTP_X_REMOTE_PROTO'] == 'https'
			|| isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
			|| isset($_SERVER['HTTP_X_HTTPS']) && ($_SERVER['HTTP_X_HTTPS'] == 'on' || $_SERVER['HTTP_X_HTTPS'] == 1)
			|| isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443
			|| isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https'
			|| isset($_SERVER['SERVER_PROTOCOL']) && preg_match('#https#i', $_SERVER['SERVER_PROTOCOL'])
			|| isset($_SERVER['HTTP_CF_VISITOR']) && preg_match('#https#i', $_SERVER['HTTP_CF_VISITOR'])
			|| isset($_SERVER['HTTP_SSL']) && $_SERVER['HTTP_SSL']);
}
function getServerPort() {
	$port = (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && is_numeric($_SERVER['HTTP_X_FORWARDED_PORT']))
		? intval($_SERVER['HTTP_X_FORWARDED_PORT'])
		: 0;
	if (!$port && isset($_SERVER['SERVER_PORT']) && is_numeric($_SERVER['SERVER_PORT'])) {
		$port = intval($_SERVER['SERVER_PORT']);
	}
	return $port;
}