<?php

include dirname(__DIR__) . "/src/World.php";

use Orfic\World;
$world = new World();

//Getting all countries list with their iso and numeric codes

$countries = $world->getCountryList();
echo $countries;

//Get A country information

$country_iso2_code = "IN";
$country_details = $world->getCountryAllDetails($country_iso2_code);
echo $country_details;

//Getting Captital Details of Country

$another_iso2_code = "US";
$capital_city_details = $world->getCapitalCity($another_iso2_code);
echo $capital_city_details;

//Get calling code for a country

$calling_code = $world->getCallingCode("GB");
echo $calling_code;

//Getting provinces of A country
$iso2_code = "AU"; //Australia
$provinces = $world->getCountryProvinces($iso2_code);
echo $provinces;