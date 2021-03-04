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

		function request_moves ($pokemon = '', $params = array()){
            function my_sort($a,$b)
            {
                if ($a['version_group_details'][0]['level_learned_at'] == $b['version_group_details'][0]['level_learned_at']) return 0;
                return ($a['version_group_details'][0]['level_learned_at'] < $b['version_group_details'][0]['level_learned_at']) ? -1 : 1;
            }
            // function my_sort2($a,$b)
            // {
            //     if ($b['version_group_details'][0]['level_learned_at'] > 0) {
            //         if ($a['version_group_details'][0]['level_learned_at'] == $b['version_group_details'][0]['level_learned_at']) return 0;
            //         return ($a['version_group_details'][0]['level_learned_at'] < $b['version_group_details'][0]['level_learned_at']) ? -1 : 1;
            //     }
            //     else {
            //         return 1;
            //     }
            // }

            $moves = $pokemon['moves'];
            uasort($moves,"my_sort");
            // uasort($moves,"my_sort2");
            // var_dump($moves); exit;

            $uri = $moves;
			if(is_array($params)){
				foreach($params as $key => $value){
					if(empty($value)) continue;
					$uri .= $key . '=' . urlencode($value) . '&';
				} 
				// $uri = substr($uri, 0, -1);
                // $response = @file_get_contents($uri);
                $response = $uri;
				$this->error = false; //var_dump($response); exit;
                // return json_decode($response, true);
                return $response;
			}
			else {
				$this->error = true;
				return false;
			}
		}
	}

?>