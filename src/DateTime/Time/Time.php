<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime\Time;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\Serializer\Mixin\DeserializerTrait;
use Borobudur\Serialization\Serializer\Mixin\SerializerTrait;
use Borobudur\Serialization\StringInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\DateTime\NowTimeInterface;
use DateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/31/16
 */
class Time
    implements SerializableInterface, DeserializableInterface, ComparisonInterface, NowTimeInterface, StringInterface
{
    use SerializerTrait, DeserializerTrait;

    /**
     * @var Hour
     */
    public $hour;

    /**
     * @var Minute
     */
    public $minute;

    /**
     * @var Second
     */
    public $second;

    /**
     * Constructor.
     *
     * @param Hour   $hour
     * @param Minute $minute
     * @param Second $second
     */
    public function __construct(Hour $hour, Minute $minute, Second $second)
    {
        $this->hour = $hour;
        $this->minute = $minute;
        $this->second = $second;
    }

    /**
     * @return static
     */
    public static function now()
    {
        return new static(Hour::now(), Minute::now(), Second::now());
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        $date = new DateTime($value);

        return new static(
            new Hour((int) $date->format('G')),
            new Minute((int) $date->format('i')),
            new Second((int) $date->format('s'))
        );
    }
    
    /**
     * @return DateTime
     */
    public function toNativeDateTime()
    {
        $time = new DateTime;
        $time->setTime($this->hour->getValue(), $this->minute->getValue(), $this->second->getValue());

        return $time;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->hour->isEmpty() && $this->minute->isEmpty() && $this->second->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        if ($value instanceof static) {
            return $value->hour->equal($this->hour)
            && $value->minute->equal($this->minute)
            && $value->second->equal($this->second);
        }

        return false;
    }

    public function format($format)
    {
        return $this->toNativeDateTime()->format($format);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->format('H:i:s');
    }
}
