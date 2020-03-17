<?php
	$config['cookie_file'] = '../../' . $ip . '.cookie';
	if (!file_exists($config['cookie_file'])) {
		$fp = @fopen($config['cookie_file'], 'w');
		@fclose($fp);
	}
	function curl($url = '', $var = '', $header = false, $nobody = false)
	{
		global $config, $sock;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_NOBODY, $header);
		curl_setopt($curl, CURLOPT_HEADER, $nobody);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($curl, CURLOPT_REFERER, 'https://www.paypal.com/');
		if ($var) {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $var);
		}
		curl_setopt($curl, CURLOPT_COOKIEFILE, $config['cookie_file']);
		curl_setopt($curl, CURLOPT_COOKIEJAR, $config['cookie_file']);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
	function fetch_value($str, $find_start, $find_end)
	{
		$start = strpos($str, $find_start);
		if ($start === false) {
			return "";
		}
		$length = strlen($find_start);
		$end	= strpos(substr($str, $start + $length), $find_end);
		return trim(substr($str, $start + $length, $end));
	}
?>