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
interface NumericComparisonInterface extends ComparisonInterface
{
    /**
     * Check whatever the current object greater than value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function greaterThan($value);
    
    /**
     * Check whatever the current object greater than equal value.
     *
     * @param bool $value
     *
     * @return bool
     */
    public function greaterThanEqual($value);

    /**
     * Check whatever the current object less than value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function lessThan($value);

    /**
     * Check whatever the current object less than equal value.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function lessThanEqual($value);
}
