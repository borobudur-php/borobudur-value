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

use Borobudur\Serialization\StringInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\DateTime\NowTimeInterface;
use DateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Date implements ComparisonInterface, NowTimeInterface, StringInterface
{
    /**
     * @var Year
     */
    public $year;

    /**
     * @var Month
     */
    public $month;

    /**
     * @var MonthDay
     */
    public $day;

    /**
     * @var WeekDay
     */
    public $weekDay;

    /**
     * Constructor.
     *
     * @param Year     $year
     * @param Month    $month
     * @param MonthDay $day
     */
    public function __construct(Year $year, Month $month, MonthDay $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
        $this->weekDay = WeekDay::cast($this->format('l'));
    }

    /**
     * @return static
     */
    public static function now()
    {
        return static::fromString((new DateTime)->format('Y-m-d'));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        $date = new DateTime($value);
        $date->setTime(0, 0, 0);

        $year = new Year(intval($date->format('Y')));
        $month = new Month($date->format('F'));
        $day = new MonthDay(intval($date->format('j')));

        return new static($year, $month, $day);
    }

    /**
     * @return DateTime
     */
    public function toNativeDateTime()
    {
        $date = new DateTime();
        $date->setDate($this->year->getValue(), $this->month->getNumericValue(), $this->day->getValue());
        $date->setTime(0, 0, 0);

        return $date;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->year->isEmpty()
        && $this->month->isEmpty()
        && $this->day->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        if ($value instanceof static) {
            return $this->year->equal($value->year)
            && $this->month->equal($value->month)
            && $this->day->equal($value->day);
        }

        return false;
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function format($format)
    {
        return $this->toNativeDateTime()->format($format);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->format('Y-m-d');
    }
}
