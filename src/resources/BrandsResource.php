<?php
/**
 * Project SphereMall SDK.
 * File: BrandsResource.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 11:10
 */

namespace spheremall\resources;

use spheremall\resources\base\BaseResource;
use spheremall\resources\traits\ResourceOne;

/**
 * Class BrandsResource
 * @package spheremall\resources
 */
class BrandsResource extends BaseResource
{
    use ResourceOne;

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return 'brands';
    }
}
