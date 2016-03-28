<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\Serializer\Mixin\DeserializerTrait;
use Borobudur\Serialization\Serializer\Mixin\SerializerTrait;
use Borobudur\Value\Comparison\ComparisonInterface;
use Borobudur\Value\Primitive\FloatValue;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Money implements SerializableInterface, DeserializableInterface, ComparisonInterface
{
    use SerializerTrait, DeserializerTrait;

    /**
     * @var FloatValue
     */
    public $money;

    /**
     * @var Currency
     */
    public $currency;

    /**
     * Constructor.
     *
     * @param FloatValue $money
     * @param Currency   $currency
     */
    public function __construct(FloatValue $money, Currency $currency)
    {
        $this->money = $money;
        $this->currency = $currency;
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
            && $value->money->equal($this->money)
            && $value->currency->equal($this->currency);
    }
}
