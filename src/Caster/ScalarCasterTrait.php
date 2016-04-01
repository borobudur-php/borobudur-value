<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Caster;

use Borobudur\ValueObject\Exception\InvalidValueException;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     4/1/16
 */
trait ScalarCasterTrait
{
    /**
     * {@inheritdoc}
     */
    public static function cast($value)
    {
        self::assertScalar($value);

        return new static($value);
    }

    /**
     * @param $value
     *
     * @throws InvalidValueException
     */
    private static function assertScalar($value)
    {
        if (!is_scalar($value)) {
            throw new InvalidValueException(sprintf(
                '"%s" is only supported cast from scalar, "%s" given.',
                get_called_class(),
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }
    }
}
