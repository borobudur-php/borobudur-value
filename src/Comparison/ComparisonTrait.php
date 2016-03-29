<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Comparison;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
trait ComparisonTrait
{
    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return empty($this->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        if (true === $this->isInstanceOfThis($value)) {
            $mine = $this->getValue();
            $value = $value->getValue();
            if ($mine instanceof ComparisonInterface) {
                return $mine->equal($value);
            }

            return $mine === $value;
        }

        return false;
    }

    /**
     * @return mixed
     */
    abstract public function getValue();

    /**
     * Check the value is instance of current class.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function isInstanceOfThis($value)
    {
        return $value instanceof static;
    }
}
