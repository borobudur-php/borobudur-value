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

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class IPv6Address implements ValuableInterface, CastableInterface, ComparisonInterface
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
        if (false === filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            throw InvalidValueException::invalidValueType($value, array('string (valid ip6 address)'));
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
}
