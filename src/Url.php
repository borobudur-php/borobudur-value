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
use Borobudur\Value\Exception\InvalidValueException;
use Borobudur\Value\Primitive\StringValue;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Url implements ValuableInterface
{
    /**
     * @var StringValue
     */
    public $url;

    /**
     * Constructor.
     *
     * @param StringValue $url
     *
     * @throws InvalidValueException
     */
    public function __construct(StringValue $url)
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidValueException(sprintf('"%s" is not valid url.', $url));
        }

        $this->url = $url;
    }

    /**
     * @return StringValue
     */
    public function getValue()
    {
        return $this->url;
    }
}
