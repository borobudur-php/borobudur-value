<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\Test;

use Borobudur\Serialization\Test\Name;
use Borobudur\Value\Money;

class Checkout {

}

class Buyer {
    /**
     * @var Name
     */
    public $name;

    /**
     * @var Money
     */
    public $money;
}

class Product {
    public $id;
}
