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

use Borobudur\Serialization\ValuableInterface;
use Borobudur\Value\Comparison\ComparisonInterface;
use Borobudur\Value\Comparison\ComparisonTrait;
use Borobudur\Value\Exception\InvalidValueException;
use Borobudur\Value\Primitive\StringValue;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class IpAddress implements ValuableInterface, ComparisonInterface
{
    use ComparisonTrait;

    /**
     * @var StringValue
     */
    protected $ip;

    /**
     * Constructor.
     *
     * @param StringValue $ip
     *
     * @throws InvalidValueException
     */
    public function __construct(StringValue $ip)
    {
        if (false === filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new InvalidValueException(sprintf('"%s" is not valid ip address.', $ip));
        }

        $this->ip = $ip;
    }

    /**
     * @return StringValue
     */
    public function getValue()
    {
        return $this->ip;
    }
}
