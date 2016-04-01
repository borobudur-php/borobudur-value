<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime\Time;

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
 * @created     3/31/16
 */
class Second implements ValuableInterface, CastableInterface, ComparisonInterface, NowTimeInterface
{
    use ScalarCasterTrait, ComparisonTrait;

    /**
     * @const in
     */
    const MIN_SECOND = 0;

    /**
     * @const int
     */
    const MAX_SECOND = 59;

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
        $options = array('options' => array('min_range' => static::MIN_SECOND, 'max_range' => static::MAX_SECOND));
        if (false === filter_var($value, FILTER_VALIDATE_INT, $options)) {
            throw InvalidValueException::invalidValueType($value, array('int (>=0 and <=59)'));
        }

        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function now()
    {
        return new static((int) (new DateTime)->format('s'));
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }
}
