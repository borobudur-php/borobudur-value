<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Money;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\Serializer\Mixin\DeserializerTrait;
use Borobudur\Serialization\Serializer\Mixin\SerializerTrait;
use Borobudur\Serialization\StringInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\SerializableCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Money\Currency;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Money
    implements SerializableInterface, DeserializableInterface, ComparisonInterface, CastableInterface, StringInterface
{
    use SerializerTrait, DeserializerTrait, SerializableCasterTrait;

    /**
     * @var string
     */
    public $money;

    /**
     * @var Currency
     */
    public $currency;

    /**
     * Constructor.
     *
     * @param float    $money
     * @param Currency $currency
     */
    public function __construct($money, Currency $currency)
    {
        $this->money = (float) $money;
        $this->currency = $currency;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        $parts = explode(' ', $value);

        return new static($parts[1], new Currency($parts[0]));
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return null === $this->money || null === $this->currency;
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        return $value instanceof static
        && $value->money === $this->money
        && $value->currency->equal($this->currency);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return sprintf('%s %d', $this->currency, $this->money);
    }
}
