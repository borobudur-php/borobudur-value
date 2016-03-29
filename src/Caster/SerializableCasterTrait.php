<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) MetroTV - MIS Department
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Caster;

use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Exception\InvalidValueException;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
trait SerializableCasterTrait
{
    /**
     * @param mixed $value
     *
     * @return static
     * @throws InvalidValueException
     */
    public static function cast($value)
    {
        if ($value instanceof ValuableInterface) {
            $value = $value->getValue();
        }

        self::assertNotScalar($value);
        if ($value instanceof SerializableInterface) {
            $value = $value->serialize();
        }

        return static::deserialize((array) $value);
    }

    /**
     * @param mixed $value
     *
     * @throws InvalidValueException
     */
    private static function assertNotScalar($value)
    {
        if (is_scalar($value)) {
            throw new InvalidValueException(sprintf(
                '"%s" value is not supported cast from scalar value.',
                get_called_class()
            ));
        }
    }
}
