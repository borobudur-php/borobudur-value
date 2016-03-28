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
trait NumericComparisonTrait
{
    use ComparisonTrait;

    /**
     * {@inheritdoc}
     */
    public function greaterThan($value)
    {
        return $this->isInstanceOfThis($value) && $this->getValue() > $value;
    }

    /**
     * {@inheritdoc}
     */
    public function greaterThanEqual($value)
    {
        return $this->isInstanceOfThis($value) && $this->getValue() >= $value;
    }

    /**
     * {@inheritdoc}
     */
    public function lessThan($value)
    {
        return $this->isInstanceOfThis($value) && $this->getValue() < $value;
    }

    /**
     * {@inheritdoc}
     */
    public function lessThanEqual($value)
    {
        return $this->isInstanceOfThis($value) && $this->getValue() <= $value;
    }
}
