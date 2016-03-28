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

use Borobudur\Serialization\Exception\SerializableInterface;
use Borobudur\Serialization\Serializer\ArraySerializer;
use Borobudur\Serialization\Serializer\FlatMixinSerializer;
use Borobudur\Serialization\Serializer\ScalarSerializer;
use Borobudur\Serialization\Serializer\SerializerInterface;
use Borobudur\Value\Filler\FillableInterface;
use Borobudur\Value\Filler\FillerTrait;
use Borobudur\Value\Filler\Parameter\ParameterFillerInterface;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Product implements SerializableInterface
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     */
    public $name;
    
    /**
     * @var Buyer
     */
    public $buyer;
    
    /**
     * Constructor.
     *
     * @param int    $id
     * @param string $name
     * @param Buyer  $buyer
     */
    public function __construct($id, $name, Buyer $buyer)
    {
        $this->id = $id;
        $this->name = $name;
        $this->buyer = $buyer;
    }
    
    /**
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        return new FlatMixinSerializer(
            array(
                (new ScalarSerializer('id', $this->id))->withPrefix('product'),
                (new ScalarSerializer('name', $this->name))->withPrefix('product'),
                $this->buyer->getSerializer(),
            )
        );
    }

    public static function create(ParameterFillerInterface $filler)
    {
        return new static($filler->get('id'), $filler->get('name'), Buyer::create($filler));
    }
}

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
class Buyer implements SerializableInterface
{
    /**
     * @var Name
     */
    public $name;
    
    /**
     * @var Money
     */
    public $total;
    
    /**
     * @var Money
     */
    public $wallet;
    
    /**
     * Constructor.
     *
     * @param Name  $name
     * @param Money $total
     * @param Money $wallet
     */
    public function __construct(Name $name, Money $total, Money $wallet)
    {
        $this->name = $name;
        $this->total = $total;
        $this->wallet = $wallet;
    }
    
    /**
     * @return FlatMixinSerializer
     */
    public function getSerializer()
    {
        return new FlatMixinSerializer(
            array(
                $this->name->getSerializer()->withSuffix('Name'),
                $this->total->getSerializer()->withField('total'),
                $this->wallet->getSerializer()->withField('wallet'),
            )
        );
    }

    public static function create(ParameterFillerInterface $filler)
    {
        return new static(
            (new Name)->fill($filler),
            new Money($filler->get('total')),
            new Money($filler->get('wallet'))
        );
    }
}

class Money implements SerializableInterface
{
    /**
     * @var int
     */
    public $money;
    
    /**
     * Constructor.
     *
     * @param int $money
     */
    public function __construct($money)
    {
        $this->money = $money;
    }
    
    /**
     * @return ScalarSerializer
     */
    public function getSerializer()
    {
        return new ScalarSerializer('money', $this->money);
    }
}

class Name implements SerializableInterface, FillableInterface
{
    use FillerTrait;

    /**
     * @var string
     */
    public $first;
    
    /**
     * @var string
     */
    public $last;
    
    /**
     * @return ArraySerializer
     */
    public function getSerializer()
    {
        return new ArraySerializer(
            array(
                'first' => $this->first,
                'last'  => $this->last,
            )
        );
    }

    /**
     * @return array
     */
    protected function fillable()
    {
        return array('first', 'last');
    }
}
