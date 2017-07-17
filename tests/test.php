<?php

ini_set('error_reporting', E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('html_errors', 1);
ini_set('log_errors', 0);
include dirname(__DIR__).'/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use \Xicrow\PhpDebug\Timer;
use Orfic\World;

class newTest extends TestCase
{
    /**
     * @method to test if website contains flash or not
     * @param $input  string/url  for which flash test has to be done
     * @param $expected_output  boolean    expected result in terms of true / false
     * @dataProvider flashTestDataProvider
     * @return fail / pass
     */
    public function testFlash($input, $expected_output)
    {
        // Sample Config for timer
        Timer::$forceDisplayUnit = 'MS';
        Timer::$colorThreshold = [
            0 => 'green',
            2000 => 'orange',
            50000 => 'red',
        ];
        Timer::start();
        $world = new World();
        $calling_code = $world->getCallingCode($input);;
        $this->assertSame($expected_output, $calling_code);
        Timer::stop();
        // Show All Timers
        Timer::showAll();
    }

    public function flashTestDataProvider()
    {
        return [
        //True cases
            "Case 1" => ["IN", '{
    "Country": "India",
    "Calling Code": 91
}'],
        ];
    }
}
