<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('getlocation')) {   
    function getlocation($lat,$lng) { 
    	if($lat !=''){
    		// use new key temprary after demo or auditing it will delete
    		$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&key=';    	
    		
	    	$json = @file_get_contents($url); 
			$data = json_decode($json);
			$typeArrayJson = $data;
			// echo "<pre>";print_r($data);exit;
			$status = $data->status;
			if($status=="OK"){
				$latlngAddress = $data->results;

				$typeArr = $latlngAddress[0]->address_components;
				$typeArr = json_decode(json_encode($typeArr), true);
				$addr =[];
				//echo"<pre>";print_r($typeArr);
				foreach ($typeArr as $eekey => $eeee) {									
					$typeArr = $eeee['types'];	
						
					if(in_array('sublocality_level_2',$typeArr)){
						$addr[] = $eeee['long_name'];
					}
					if(in_array('sublocality_level_1',$typeArr)){
						$addr[] = $eeee['long_name'];
					}
					if(in_array('locality',$typeArr)){
						$addr[] = $eeee['long_name'];
						$city = $eeee['long_name'];
					}
					if(in_array('administrative_area_level_1',$typeArr)){
						$addr[] = $eeee['long_name'];
						$state = $eeee['long_name'];
					}
					if(in_array('country',$typeArr)){
						$addr[] = $eeee['long_name'];
					}
					if(in_array('postal_code',$typeArr)){
						$addr[] = $eeee['long_name'];
						$picode = $eeee['long_name'];
					}					
				}
			

				$gpsData['custom_address'] = implode(', ', $addr);
				$gpsData['formatted_address'] = $data->results[0]->formatted_address;
				$gpsData['gps_city'] = $city;
				$gpsData['gps_state'] = $state;
				$gpsData['gps_pincode'] = $picode;
				$gpsData['gpsjson'] = $typeArrayJson;
				return $gpsData;	
				//return $fullAddress;	
				//return $data->results[0]->formatted_address;	
			} else{
				return false;		
			}
		}else{
			return false;
	    }
	}
}