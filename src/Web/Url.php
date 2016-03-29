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
class Url implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ComparisonTrait, ValuableCasterTrait;

    /**
     * @var string
     */
    public $url;

    /**
     * Constructor.
     *
     * @param string $url
     *
     * @throws InvalidValueException
     */
    public function __construct($url)
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidValueException(sprintf('"%s" is not valid url.', $url));
        }

        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->url;
    }
}
