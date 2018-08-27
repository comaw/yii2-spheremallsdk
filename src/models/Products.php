<?php
/**
 * Project SphereMall SDK.
 * File: Products.php
 * Created by Sergey Yanchevsky
 * 27.08.2018 13:23
 */

namespace spheremall\models;

use spheremall\models\base\ModelBase;

/**
 * Class Products
 * @package spheremall\models
 *
 * @property int $id
 * @property string $urlCode
 * @property string $title
 *
 * @property Brands $brands
 *
 */
class Products extends ModelBase
{

    public function getBrands(): array
    {
        return $this->hasOne('brands', ['id', 'brandId']);
    }
}
