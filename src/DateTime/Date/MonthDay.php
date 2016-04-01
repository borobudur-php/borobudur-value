<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime\Date;

use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\ScalarCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\DateTime\NowTimeInterface;
use Borobudur\ValueObject\Exception\InvalidValueException;
use DateTime;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class MonthDay implements ValuableInterface, ComparisonInterface, CastableInterface, NowTimeInterface
{
    use ScalarCasterTrait, ComparisonTrait;

    /**
     * @const int
     */
    const MIN_MONTH_DAY = 1;

    /**
     * @const int
     */
    const MAX_MONTH_DAY = 31;

    /**
     * @var int
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param int $value
     *
     * @throws InvalidValueException
     */
    public function __construct($value)
    {
        $value = (int) $value;
        $options = array(
            'options' => array(
                'min_range' => MonthDay::MIN_MONTH_DAY,
                'max_range' => MonthDay::MAX_MONTH_DAY,
            ),
        );
        if (false === filter_var($value, FILTER_VALIDATE_INT, $options)) {
            throw InvalidValueException::invalidValueType($value, array('int (>=1 and <= 31)'));
        }

        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function now()
    {
        return new static((int) (new DateTime)->format('j'));
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
