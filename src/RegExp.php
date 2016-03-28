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
class RegExp implements ValuableInterface
{
    /**
     * @var StringValue
     */
    protected $regexp;

    /**
     * Constructor.
     *
     * @param StringValue $regexp
     *
     * @throws InvalidValueException
     */
    public function __construct(StringValue $regexp)
    {
        if (false === filter_var($regexp, FILTER_VALIDATE_REGEXP)) {
            throw new InvalidValueException(sprintf('"%s" is not valid regular expression value.', $regexp));
        }

        $this->regexp = $regexp;
    }

    /**
     * @return StringValue
     */
    public function getValue()
    {
        return $this->regexp;
    }
}
