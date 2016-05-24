<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class VideoInformationController extends Controller
{
    public function getMinutesDurationYoutube()
    {
    	try{
    	$id = Input::get('id');
		$vidkey = $id; 
		$apikey = "AIzaSyCHhS0UhK0lUIOp0FNpyzH-HYPPEGuCVs4";
		$dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$vidkey&key=$apikey");
		$VidDuration =json_decode($dur, true);
		foreach ($VidDuration['items'] as $vidTime) 
		{
			$VidDuration= $vidTime['contentDetails']['duration'];
		}
		preg_match_all('/(\d+)/',$VidDuration,$parts);
		$hours = intval(floor($parts[0][0]/60) * 60 * 60);
		$minutes = intval($parts[0][0]%60 * 60) / 60;
		$seconds = intval($parts[0][1]);
		$totalSec = $hours + $minutes + $seconds; 
		$minutesSeconds = $minutes.".".$seconds;
		return floatval($minutesSeconds);
		}
		catch(\Exception $e){
			return -1;
		}
    }

    //6381c8620c859777c21b3f4f2c7de3ad

    public function getMinutesDurationVimeo(){

   	$video_id = (int) Input::get('id');

   	$json_url = 'http://vimeo.com/api/v2/video/' . $video_id . '.xml';

   	$ch = curl_init($json_url);
   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   	curl_setopt($ch, CURLOPT_HEADER, 0);
   	$data = curl_exec($ch);
   	curl_close($ch);
   	$data = new \SimpleXmlElement($data, LIBXML_NOCDATA);

   	if (!isset($data->video->duration)) {
    	   return null;
   	}

   	$duration = $data->video->duration;

   	return (float) ($duration / 60.0); // in minutes
    }


    public function getMinutesDurationDayliMotion(){
    	$id = Input::get('id');
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.dailymotion.com/video/".$id."?fields=id,title,thumbnail_url,tags,duration,embed_url");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$results = curl_exec($ch);
		curl_close($ch);
		$results = json_decode($results);
		if (!$results) {
    		return false;
			} 
		else {
		
    		return (float) ($results->duration / 60);
			}

	

	
    }

    public function getMinutesDurationTwitch(){
    	$id = Input::get('id');
    	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/kraken/videos/v".$id);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		$results = curl_exec($ch);
		curl_close($ch);
		$results = json_decode($results);
		if (!$results) {
    		return false;
			} 
		else {
		
    		return (float) ($results->length / 60);
			}

	

	
    }

    //https://api.twitch.tv/kraken/videos/v
}
