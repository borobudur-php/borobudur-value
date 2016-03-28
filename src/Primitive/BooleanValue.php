<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\Primitive;

use Borobudur\Serialization\ValuableInterface;
use Borobudur\Value\Comparison\ComparisonInterface;
use Borobudur\Value\Comparison\ComparisonTrait;
use Borobudur\Value\Exception\InvalidValueException;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
class BooleanValue implements ValuableInterface, ComparisonInterface
{
    use ComparisonTrait;

    /**
     * @var bool
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param bool $value
     *
     * @throws InvalidValueException
     */
    public function __construct($value)
    {
        if (static::isFalse($value)) {
            $this->value = false;
        } elseif (static::isTrue($value)) {
            $this->value = true;
        } else {
            throw new InvalidValueException(sprintf('"%s" is not boolean value.'));
        }
    }

    /**
     * Check the value is false.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function isFalse($value)
    {
        return in_array($value, array(false, 'false', 'off'));
    }

    /**
     * Check the value is true.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function isTrue($value)
    {
        return in_array($value, array(true, 'true', 'on'));
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}
