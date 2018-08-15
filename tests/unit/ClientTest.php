<?php

use spheremall\Client;

/**
 * Class ClientTest
 */
class ClientTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $configLocal = [];
    
    protected function _before()
    {
        $this->configLocal = \Helper\Unit::getConfigLocal();
    }

    protected function _after()
    {
    }

    /**
     * tests connection to API
     *
     * @throws \yii\web\HttpException
     */
    public function testConnection()
    {
        $client = Client::app($this->configLocal);

        $this->assertTrue(is_a($client, Client::class));
        $this->assertTrue(is_a($client, Client::class));
    }
}
