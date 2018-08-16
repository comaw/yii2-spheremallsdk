<?php
/**
 * Project SphereMall SDK.
 * File: ProductsResource.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 11:10
 */

namespace spheremall\resources;

use spheremall\resources\base\BaseResource;

/**
 * Class ProductsResource
 * @package spheremall\resources
 */
class ProductsResource extends BaseResource
{
    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return 'products';
    }
}
