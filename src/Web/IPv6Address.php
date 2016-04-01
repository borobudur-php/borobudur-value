<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Web;

use Borobudur\Serialization\StringInterface;
use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\Exception\InvalidValueException;
use Borobudur\ValueObject\StringLiteral\StringLiteral;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class IPv6Address implements ValuableInterface, ComparisonInterface, StringInterface
{
    use ComparisonTrait;

    /**
     * @var StringLiteral
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param StringLiteral $value
     *
     * @throws InvalidValueException
     */
    public function __construct(StringLiteral $value)
    {
        if (false === filter_var($value->getValue(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            throw InvalidValueException::invalidValueType($value, array('string (valid ip6 address)'));
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
        return (string) $this->getValue();
    }
}
