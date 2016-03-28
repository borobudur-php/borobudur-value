<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\Primitive;

use Borobudur\Serialization\ValuableInterface;
use Borobudur\Value\Comparison\NumericComparisonInterface;
use Borobudur\Value\Comparison\NumericComparisonTrait;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
class IntegerValue implements ValuableInterface, NumericComparisonInterface
{
    use NumericComparisonTrait;

    /**
     * @var int
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value = (int) $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
}
