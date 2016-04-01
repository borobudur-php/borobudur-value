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
 * @created     3/27/16
 */
class Month extends AbstractEnum implements NowTimeInterface
{
    /**
     * @const string
     */
    const JANUARY = 'January';

    /**
     * @const string
     */
    const FEBRUARY = 'February';

    /**
     * @const string
     */
    const MARCH = 'March';

    /**
     * @const string
     */
    const APRIL = 'April';

    /**
     * @const string
     */
    const MAY = 'May';

    /**
     * @const string
     */
    const JUNE = 'June';

    /**
     * @const string
     */
    const JULY = 'July';

    /**
     * @const string
     */
    const AUGUST = 'August';

    /**
     * @const string
     */
    const SEPTEMBER = 'September';

    /**
     * @const string
     */
    const OCTOBER = 'October';

    /**
     * @const string
     */
    const NOVEMBER = 'November';

    /**
     * @const string
     */
    const DECEMBER = 'December';

    /**
     * @return static
     */
    public static function now()
    {
        return new static((new DateTime)->format('F'));
    }

    /**
     * @return int
     */
    public function getNumericValue()
    {
        return $this->getOrdinal() + 1;
    }
}
