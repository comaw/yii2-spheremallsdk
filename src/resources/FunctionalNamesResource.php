<?php
/**
 * Project SphereMall SDK.
 * File: FunctionalNamesResource.php
 * Created by Sergey Yanchevsky
 * 22.08.2018 11:10
 */

namespace spheremall\resources;

use spheremall\makers\interfaces\MakerInterface;
use spheremall\resources\base\BaseResource;

/**
 * Class FunctionalNamesResource
 * @package spheremall\resources
 */
class FunctionalNamesResource extends BaseResource
{
    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return 'functionalnames';
    }

    public function setMaker(MakerInterface $maker)
    {
        $this->maker = $maker;

        return $this;
    }
}
