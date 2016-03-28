<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\Comparison;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
interface ComparisonInterface
{
    /**
     * Check the value is empty.
     *
     * @return bool
     */
    public function isEmpty();

    /**
     * Check whatever the value is match with current object.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function equal($value);
}
