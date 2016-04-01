<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime\Date;

use Borobudur\ValueObject\DateTime\NowTimeInterface;
use Borobudur\ValueObject\Enum\AbstractEnum;
use DateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class WeekDay extends AbstractEnum implements NowTimeInterface
{
    /**
     * @const string
     */
    const MONDAY    = 'Monday';

    /**
     * @const string
     */
    const TUESDAY   = 'Tuesday';

    /**
     * @const string
     */
    const WEDNESDAY = 'Wednesday';

    /**
     * @const string
     */
    const THURSDAY  = 'Thursday';

    /**
     * @const string
     */
    const FRIDAY    = 'Friday';

    /**
     * @const string
     */
    const SATURDAY  = 'Saturday';

    /**
     * @const string
     */
    const SUNDAY    = 'Sunday';

    /**
     * @return static
     */
    public static function now()
    {
        return new static((new DateTime())->format('l'));
    }
}
