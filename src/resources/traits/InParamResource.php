<?php
/**
 * Project SphereMall SDK.
 * File: InParamResource.php
 * Created by Sergey Yanchevsky
 * 20.08.2018 12:46
 */

namespace spheremall\resources\traits;

use yii\helpers\Json;

/**
 * Trait InParamResource
 * @package spheremall\resources\traits
 */
trait InParamResource
{
    /**
     * Add in params
     * For example:
     * ['url', ['some_url', '1', 'any']] => [{"url":["some_url", "1", "any"]}]
     *
     *
     * @param array $in
     *
     * @return Resource|$this
     */
    public function in(array $in)
    {
        $where = Json::decode($this->queriesParams['where'] ?? "[]", true);
        $where[] = [$param[1] => [$param[0] => $param[2]]];
        $this->queriesParams['where'] = Json::encode($where);

        return $this;
    }
}
