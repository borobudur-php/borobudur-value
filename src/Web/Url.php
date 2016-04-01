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

use Borobudur\Serialization\StringInterface;
use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\Exception\InvalidValueException;
use Borobudur\ValueObject\StringLiteral\StringLiteral;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Url implements ValuableInterface, ComparisonInterface, StringInterface
{
    use ComparisonTrait;

    /**
     * @var StringLiteral
     */
    public $url;

    /**
     * Constructor.
     *
     * @param StringLiteral $url
     *
     * @throws InvalidValueException
     */
    public function __construct(StringLiteral $url)
    {
        if (false === filter_var($url->getValue(), FILTER_VALIDATE_URL)) {
            throw new InvalidValueException(sprintf('"%s" is not valid url.', $url));
        }

        $this->url = $url;
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
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
