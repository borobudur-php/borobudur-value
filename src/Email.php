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
class Email implements ValuableInterface, ComparisonInterface
{
    use ComparisonTrait;

    /**
     * @var StringValue
     */
    protected $email;

    /**
     * Constructor.
     *
     * @param StringValue $email
     *
     * @throws InvalidValueException
     */
    public function __construct(StringValue $email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueException(sprintf('"%s" is not valid email address.', $email));
        }

        $this->email = $email;
    }

    /**
     * @return StringValue
     */
    public function getValue()
    {
        return $this->email;
    }
}
