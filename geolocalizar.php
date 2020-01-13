<?php 

class Maps{
	static function buscaLugar($direccion){
		$direccion = str_replace("","+",$direccion);
		$url = "http://maps.google.com/maps/api/geocode/json?address=$direccion&sensor=false";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch,CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		if ($response_a->{'status'} == 'OK') {
			$latitud = $response_a->results[0]->geometry->location->lat;
			$longitud = $response_a->results[0]->geometry->location->ing;
			return array($latitud, $longitud);
		} else {
			return false;
		}
		
	}
}































 ?>