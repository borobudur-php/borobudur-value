<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) MetroTV - MIS Department
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime;

use Borobudur\Serialization\StringInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\DateTime\Date\Date;
use Borobudur\ValueObject\DateTime\Time\Time;
use DateTime as NativeDateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
class DateTime implements ComparisonInterface, NowTimeInterface, StringInterface
{
    /**
     * @var Date
     */
    public $date;

    /**
     * @var Time
     */
    public $time;

    /**
     * Constructor.
     *
     * @param Date $date
     * @param Time $time
     */
    public function __construct(Date $date, Time $time)
    {
        $this->date = $date;
        $this->time = $time;
    }

    /**
     * @return static
     */
    public static function now()
    {
        return new static(Date::now(), Time::now());
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        return new static(Date::fromString($value), Time::fromString($value));
    }

    /**
     * @return NativeDateTime
     */
    public function toNativeDateTime()
    {
        return new NativeDateTime(sprintf('%s %s', (string) $this->date, (string) $this->time));
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->date->isEmpty() && $this->time->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        if ($value instanceof static) {
            return $value->date->equal($this->date) && $this->time->equal($this->time);
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
        return $this->format('Y-m-d H:i:s');
    }
}
