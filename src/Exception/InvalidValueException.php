<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Exception;

use Exception;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class InvalidValueException extends Exception
{
    /**
     * @param string $value
     * @param array  $allowed
     *
     * @return static
     */
    public static function invalidValueType($value, array $allowed)
    {
        return new static(sprintf(
            'Argument "%s" is invalid. Allowed types for argument are "%s".',
            $value,
            implode(', ', $allowed)
        ));
    }
}
