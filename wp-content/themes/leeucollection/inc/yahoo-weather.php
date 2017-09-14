<?php
class Yahoo_Weather
{
	protected $base_url = "http://query.yahooapis.com/v1/public/yql";
	protected $location = false;
	protected $units 	= false;
	protected $current 	= false;
	protected $future 	= false;
	protected $data 	= false;

	public function __construct($location)
	{
		if($location != "")
		{
			$this->location = $location;
			$this->getWeather();
		}
	}
	private function getWeather()
	{
		if($this->location)
		{
			$yql_query 	= 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$this->location.'")';

			$yql_query_url 	= $this->base_url . "?q=" . urlencode($yql_query) . "&format=json";
			$curl 			= curl_init($yql_query_url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			$json 			= curl_exec($curl);
			$data 			= json_decode($json);

			$this->data		= $data->query;
			if($data->query->count)
			{
				$this->units	= $data->query->results->channel->units;
				$this->current	= $data->query->results->channel->item->condition;
				$this->future	= $data->query->results->channel->item->forecast;
			}
		}
	}
}
class Display_Weather extends Yahoo_Weather
{	
	private $temp = false;
	
	public function __construct($location, $temp)
	{
		try {			
			switch($temp)
			{
				case "c":
				case "f":
					parent::__construct($location);
				 	$this->temp = $temp;
				break;
					
				default:
					throw new Exception("Temperature must be in either C or F.");
				break;
			}
		}
		catch (Exception $e)
		{
		    echo $e->getMessage(), "\n";
		}
	}
	public function displayCurrentWeather()
	{
		if($this->current != false)
		{
			echo '<div class="wthr-wrapper text-center">';
	        /*echo '<div class="chat-icon-wrap"><img src="'.get_template_directory_uri().'/images/weather-icons/'.$this->current->code.'.png" /></div>';*/
	        echo '<div class="chat-icon-wrap wi wi-icon-'.$this->current->code.'"></div>';
	        echo '<span class="text-cht-wthr">'.$this->getTemp($this->current->temp).'</span>';
	        echo '</div>';
		}
	}
	private function getTemp($temperature)
	{
		if($this->temp == "c")
		{
			return round(($temperature - 32) /1.8) . "&deg; C";
		}		
		return $temperature."&deg; F";
	}
}
?>