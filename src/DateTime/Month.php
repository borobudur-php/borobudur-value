<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\DateTime;

use Borobudur\Serialization\ValuableInterface;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Month implements ValuableInterface
{
    /**
     * @var DateLength
     */
    public $length;

    /**
     * Constructor.
     *
     * @param int $month
     */
    public function __construct($month)
    {
        $this->length = DateLength::fromMonth($month);
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->length->toMonth();
    }
}
