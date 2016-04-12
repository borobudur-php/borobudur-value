<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Person;

use Borobudur\ValueObject\Enum\AbstractEnum;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Gender extends AbstractEnum
{
    /**
     * @const string
     */
    const MALE = 'Male';

    /**
     * @const string
     */
    const FEMALE = 'Female';
}
