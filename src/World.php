<?php

/**
 * @package Geography Package to get Most of the geographical data all around
 * @author  Meraj Ahmad Siddiqui <merajsiddiqui@outlook.com>
 * @version Stable First version to get much of the geographical data
 */

namespace Orfic;

class World {

	/**
	 * Filepath where all data are stored
	 * @var string
	 */
	private $filepath;

	/**
	 * Define file path for data resources
	 */
	public function __construct() {
		$this->filepath = dirname(__FILE__) . "/data/";
	}
	/**
	 * Fetching all countries list of the world
	 * @return json Countries name list
	 */
	public function getCountryList() {
		$filename = $this->filepath . "countries.json";
		$countries = [];
		$country_data = json_decode(file_get_contents($filename), true);
		return json_encode($country_data, JSON_PRETTY_PRINT);
	}
	/**
	 * Will Return Calling Code For the specified country
	 * @param  string $country country code
	 * @return integer          Calling code for that country
	 */
	public function getCallingCode($country_iso2_code) {
		$search_data = $this->searchCountry($country_iso2_code);
		if (!isset($search_data["error_code"])) {
			$data = [
				"Country" => $search_data["Name"],
				"Calling Code" => (int) $search_data['TelPref'],
			];
		} else {
			$data = $search_data;
		}
		return json_encode($data, JSON_PRETTY_PRINT);
	}

	public function getCapitalCity($country_iso2_code) {
		$search_data = $this->searchCountry($country_iso2_code);
		if (!isset($search_data["error_code"])) {
			$data = [
				"Country" => $search_data["Name"],
				"Capital City" => $search_data['Capital'],
			];
		} else {
			$data = $search_data;
		}
		return json_encode($data, JSON_PRETTY_PRINT);
	}

	protected function searchCountry($country_iso2_code) {
		$country_code = strtoupper($country_iso2_code);
		$filename = $this->filepath . "/countries/$country_code.json";
		$file_exist = is_file($filename);
		if ($file_exist) {
			$data = json_decode(file_get_contents($filename), true);

		} else {
			$data = [
				"error_code" => 404,
				"message" => "Country Code Not Found",
			];
		}
		return $data;
	}

	public function getCountryAllDetails($country_iso2_code) {
		$search_data = $this->searchCountry($country_iso2_code);
		return json_encode($search_data, JSON_PRETTY_PRINT);
	}
}