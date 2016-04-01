<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\StringLiteral;

use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\ScalarCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\Exception\InvalidValueException;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Regex implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ComparisonTrait, ScalarCasterTrait;

    /**
     * @var string
     */
    protected $regexp;

    /**
     * Constructor.
     *
     * @param string $regexp
     *
     * @throws InvalidValueException
     */
    public function __construct($regexp)
    {
        if (false === filter_var($regexp, FILTER_VALIDATE_REGEXP)) {
            throw new InvalidValueException(sprintf('"%s" is not valid regular expression value.', $regexp));
        }

        $this->regexp = $regexp;
    }

    /**
     * Check the given value is match with regexp.
     *
     * @param string $value
     *
     * @return bool|int
     */
    public function isMatch($value)
    {
        return preg_match($this->regexp, $value);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->regexp;
    }
}
