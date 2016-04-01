<?php
/**
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
 * @created     3/31/16
 */
class InvalidTimeZoneException extends Exception
{
    /**
     * @param string $name
     *
     * @return static
     */
    public static function invalidName($name)
    {
        return new static(sprintf(
            'The timezone "%s" is invalid. Check "timezone_identifiers_list()" for valid values.',
            $name
        ));
    }
}
