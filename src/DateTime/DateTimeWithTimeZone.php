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

use Borobudur\Serialization\StringInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use DateTime as NativeDateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/31/16
 */
class DateTimeWithTimeZone implements ComparisonInterface, StringInterface, NowTimeInterface
{
    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var TimeZone
     */
    public $timeZone;

    /**
     * Constructor.
     *
     * @param DateTime $dateTime
     * @param TimeZone $timeZone
     */
    public function __construct(DateTime $dateTime, TimeZone $timeZone = null)
    {
        $this->dateTime = $dateTime;
        $this->timeZone = $timeZone;
    }

    /**
     * @return static
     */
    public static function now()
    {
        return new static(DateTime::now(), TimeZone::fromDefault());
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        $parts = explode(' ', $value);
        $dateTime = DateTime::fromString($value);
        $timeZone = isset($parts[2]) ? TimeZone::fromString($parts[2]) : null;

        return new static($dateTime, $timeZone);
    }

    /**
     * @return NativeDateTime
     */
    public function toNativeDateTime()
    {
        $date = $this->dateTime->toNativeDateTime();
        if (null !== $this->timeZone) {
            $date->setTimezone($this->timeZone->toNativeDateTimeZone());
        }

        return $date;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->dateTime->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        if ($value instanceof static) {
            $dateTime = $this->dateTime->equal($value->dateTime);
            $timeZone = null !== $this->timeZone ? $this->timeZone->equal($value->timeZone) : null === $value->timeZone;

            return $dateTime && $timeZone;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->dateTime, $this->timeZone);
    }
}
