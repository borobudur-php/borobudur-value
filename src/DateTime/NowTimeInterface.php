<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
interface NowTimeInterface
{
    /**
     * @return static
     */
    public static function now();
}
