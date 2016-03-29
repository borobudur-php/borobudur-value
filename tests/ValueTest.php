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

use Borobudur\Value\DateTime\DateLength;
use Borobudur\Value\DateTime\Month;
use Borobudur\Value\DateTime\Year;
use Borobudur\Value\Email;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class ValueTest extends \PHPUnit_Framework_TestCase
{
    protected $data;

    protected function setUp()
    {
        $this->data = array(
            'productId' => 1,
            'productName' => 'Pencil',
            'firstName' => 'Iqbal',
            'lastName' => 'Maulana',
            'total' => 5000,
            'wallet' => 10000
        );
    }

    public function testEmailComparison()
    {
        $email = new Email('iq.bluejack@gmail.com');

        $this->assertFalse($email->equal('iq.bluejack@gmail.com'));
        $this->assertTrue($email->equal(new Email('iq.bluejack@gmail.com')));
    }

    public function testDateComparison()
    {
        return (new Integer(1))->getValue() * $integer2->getValue();
    }
}

class Money {
    
    /**
     * Constructor.
     *
     * @param Integer $int
     */
    public function __construct(Integer $int)
    {
    }
}

class Integer {
    /**
     * @var int
     */
    protected $int;

    /**
     * Constructor.
     */
    public function __construct($int)
    {
        $this->int = $int;
    }

    function __toString()
    {
        return (string) $this->int;
    }
}
