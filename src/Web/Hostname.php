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

use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\ValuableCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\Exception\InvalidValueException;
use Borobudur\ValueObject\StringLiteral\RegExp;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Hostname implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ValuableCasterTrait, ComparisonTrait;

    /**
     * @var string
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param string $value
     *
     * @throws InvalidValueException
     */
    public function __construct($value)
    {
        $value = (string) $value;
        if (false === $this->regex()->isMatch($value)) {
            throw InvalidValueException::invalidValueType($value, array('string (valid hostname)'));
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return RegExp
     */
    protected function regex()
    {
        return new RegExp(
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
