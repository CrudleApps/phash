<?php

namespace Crudle\Phash;

class ConfigTest extends \PHPUnit_Framework_TestCase 
{
    public function test_default_algo_is_phps_native_default_algo()
    {
        $this->assertEquals(1, (new Config)->getAlgo());
    }
}
