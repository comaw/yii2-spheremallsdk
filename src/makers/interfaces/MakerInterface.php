<?php
/**
 * Project SphereMall SDK.
 * File: MakerInterface.php
 * Created by Sergey Yanchevsky
 * 23.08.2018 18:00
 */

namespace spheremall\makers\interfaces;

/**
 * Interface MakerInterface
 * @package spheremall\makers\interfaces
 */
interface MakerInterface
{

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data);

    /**
     * @return $this
     */
    public function generate();

    /**
     * @return array
     */
    public function getEntities(): array;
}
