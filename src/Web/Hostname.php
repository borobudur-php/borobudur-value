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
use Borobudur\ValueObject\StringLiteral\Regex;
use Borobudur\ValueObject\StringLiteral\StringLiteral;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Hostname implements ValuableInterface, ComparisonInterface, StringInterface
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
        if (false === $value->match($this->regex())) {
            throw InvalidValueException::invalidValueType($value, array('string (valid hostname)'));
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

    /**
     * @return Regex
     */
    protected function regex()
    {
        return new Regex(
            sprintf(
                "/^%s$/",
                implode('', array(
                    '(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*',
                    '([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])'
                ))
            )
        );
    }
}
