<?php

class PoweranalyzerTableSeeder extends Seeder
{

	public function run()
	{
		Poweranalyzer::create(array(
			"bulb_id" => 1,
			"stat" => "InRange",
			"watts" => "10.8765",
			"va" => "0.098764",
			"var_" => "0.9878009",
			"pf" => "0.0987",
			"volt" => "0.0987",
			"ampere" => "245.0",
			"timestamp" => "2013-11-13 02:25:41"
		));

		Poweranalyzer::create(array(
			"bulb_id" => 2,
			"stat" => "InRange",
			"watts" => "0.092244",
			"va" => "0.098812",
			"var_" => "0.08871",
			"pf" => "0.09886",
			"volt" => "0.00987",
			"ampere" => "100.0",
			"timestamp" => "2013-11-13 02:25:46"
		));

		Poweranalyzer::create(array(
			"bulb_id" => 3,
			"stat" => "InRange",
			"watts" => "0.00987",
			"va" => "0.09485",
			"var_" => "0.12445",
			"pf" => "0.09847",
			"volt" => "0.088575",
			"ampere" => "125.0",
			"timestamp" => "2013-11-13 02:27:00"
		));

		Poweranalyzer::create(array(
			"bulb_id" => 1,
			"stat" => "InRange",
			"watts" => "12.23423",
			"va" => "0.2312",
			"var_" => "90.2213",
			"pf" => "12.3123",
			"volt" => "342.12993",
			"ampere" => "993.21230",
			"timestamp" => "2013-11-13 02:25:41"
		));




	}

}
