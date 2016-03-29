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

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
interface CastableInterface
{
    /**
     * Cast value to current object.
     *
     * @param mixed $value
     *
     * @return static
     */
    public static function cast($value);
}
