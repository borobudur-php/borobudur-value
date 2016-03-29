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

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class DateLength implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ValuableCasterTrait, ComparisonTrait;

    /**
     * @const int
     */
    const MONTH_IN_DAYS = 30.4167;

    /**
     * @const int
     */
    const YEAR_IN_DAYS = 365;

    /**
     * @var int
     */
    public $days;

    /**
     * Constructor.
     *
     * @param int $days
     */
    public function __construct($days)
    {
        $this->days = (int) $days;
    }

    /**
     * @param int $months
     *
     * @return static
     */
    public static function fromMonth($months)
    {
        return new static(((int) $months) * DateLength::MONTH_IN_DAYS);
    }

    /**
     * @param int $years
     *
     * @return static
     */
    public static function fromYear($years)
    {
        return new static(((int) $years) * DateLength::YEAR_IN_DAYS);
    }

    /**
     * @return float
     */
    public function toMonth()
    {
        return $this->days / DateLength::MONTH_IN_DAYS;
    }

    /**
     * @return int
     */
    public function toYear()
    {
        return $this->days / DateLength::YEAR_IN_DAYS;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->days;
    }
}
