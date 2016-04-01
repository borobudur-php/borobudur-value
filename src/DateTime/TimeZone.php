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
use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\ValuableCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\Exception\InvalidTimeZoneException;
use Borobudur\ValueObject\StringLiteral\StringLiteral;
use DateTimeZone;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/31/16
 */
class TimeZone implements ValuableInterface, ComparisonInterface, CastableInterface, StringInterface
{
    use ValuableCasterTrait, ComparisonTrait;

    /**
     * @var StringLiteral
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param StringLiteral $value
     */
    public function __construct(StringLiteral $value)
    {
        if (false === in_array((string) $value, timezone_identifiers_list())) {
            InvalidTimeZoneException::invalidName($value);
        }
        
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        return new static(new StringLiteral($value));
    }

    /**
     * {@inheritdoc}
     */
    public static function fromDefault()
    {
        return static::fromString(date_default_timezone_get());
    }

    /**
     * @return DateTimeZone
     */
    public function toNativeDateTimeZone()
    {
        return new DateTimeZone((string) $this->value);
    }

    /**
     * @return StringLiteral
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->value;
    }
}
