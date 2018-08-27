<?php
/**
 * Project SphereMall SDK.
 * File: ModelInterface.php
 * Created by Sergey Yanchevsky
 * 23.08.2018 17:46
 */

namespace spheremall\models\interfaces;

use spheremall\models\base\ModelBase;

/**
 * Interface ModelInterface
 * @package spheremall\models\interfaces
 */
interface ModelInterface
{
    /**
     * @param array $attributes
     *
     * @return ModelBase
     */
    public function setAttributes(array $attributes);
}
