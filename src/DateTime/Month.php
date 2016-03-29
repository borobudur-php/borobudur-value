<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime;

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
class Month implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ComparisonTrait, ValuableCasterTrait;

    /**
     * @var int
     */
    public $length;

    /**
     * Constructor.
     *
     * @param int $month
     *
     * @throws InvalidValueException
     */
    public function __construct($month)
    {
        $month = (int) $month;
        if ($month < 1 || $month > 12) {
            throw new InvalidValueException(sprintf('Month should range from 1 - 12.'));
        }

        $this->length = $month;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->length;
    }
}
