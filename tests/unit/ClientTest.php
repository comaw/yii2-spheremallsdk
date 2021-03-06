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
     * tests setting configs
     *
     * @throws \yii\web\HttpException
     */
    public function testSetConfigs()
    {
        $client = Client::app($this->configLocal);

        $this->assertTrue(is_a($client, Client::class));
        $this->assertTrue(is_a($client, Client::class));
    }

    /**
     * Test resource set and use
     *
     * @throws \yii\web\HttpException
     */
    public function testResource()
    {
        $client = Client::app($this->configLocal);

        $this->assertTrue(is_a($client->brands, \spheremall\resources\interfaces\Resource::class));

//        $content = $client->brands->one(1);
        /** @var \spheremall\models\Products[] $entities */
        $entities = $client->products->where(['e', 'urlCode', 'vers-sushi-teriyaki-kip-maki'])
            ->with(['brands', 'functionalnames'])
            ->where(['e', 'visible', '1'])
            ->limit(2)
            ->offset(0)
            ->one();
        $entities[0]->id;

        $m = 1;
    }
}
