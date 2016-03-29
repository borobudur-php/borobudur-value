<?php
/*
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
 * @created     3/27/16
 */
class Email implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ComparisonTrait, ValuableCasterTrait;

    /**
     * @var string
     */
    protected $email;

    /**
     * Constructor.
     *
     * @param string $email
     *
     * @throws InvalidValueException
     */
    public function __construct($email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidValueException(sprintf('"%s" is not valid email address.', $email));
        }

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->email;
    }
}
