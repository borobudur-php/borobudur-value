<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Geography;

use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\ScalarCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Longitude implements ValuableInterface, CastableInterface, ComparisonInterface
{
    use ScalarCasterTrait, ComparisonTrait;

    /**
     * @var float
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param float $value
     */
    public function __construct($value)
    {
        $this->value = (float) $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }
}
