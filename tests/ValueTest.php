<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value\Test;

use Borobudur\Value\Filler\Parameter\ParameterFiller;

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

    public function testFiller()
    {
        $filler = (new ParameterFiller($this->data))->removePrefix('product')->removeSuffix('Name');
        $product = Product::create($filler);
        
    }
}
