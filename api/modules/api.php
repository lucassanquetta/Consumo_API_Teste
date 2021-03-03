<?php

	class API {
		private $key = null;
		private $error = false;
		
		function __construct($key = null){
			if(!empty($key)) $this->key = $key;
		}

		function request ($endpoint = '', $params = array()){
            // $uri = "https://pokeapi.co/api/v2/pokemon/" . $endpoint . "key=" . $this->key;
            $uri = "https://pokeapi.co/api/v2/pokemon/" . $endpoint;
			if(is_array($params)){
				foreach($params as $key => $value){
					if(empty($value)) continue;
					$uri .= $key . '=' . urlencode($value) . '&';
				}
				// $uri = substr($uri, 0, -1);
				$response = @file_get_contents($uri);
				$this->error = false;
				return json_decode($response, true);
			}
			else {
				$this->error = true;
				return false;
			}
		}

		function is_error() {
			return $this->error;
		}

		// function tipo_pokemon_ditto(){
		// 	$data = $this->request('ditto'); var_dump($data['types']['type']); exit;
		// 	if(!empty($data) && is_array($data['types']['type']['name'])){
		// 		$this->error = false;
		// 	}
		// 	else{
		// 		$this->error = true;
		// 		return false;
		// 	}
		// }
	}

?>