<?php
/*
 * This file is part of the Borobudur-Value package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\Value;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\Serializer\Mixin\DeserializerTrait;
use Borobudur\Serialization\Serializer\Mixin\SerializerTrait;
use Borobudur\Value\Comparison\ComparisonInterface;
use Borobudur\Value\Primitive\FloatValue;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
class Location implements SerializableInterface, DeserializableInterface, ComparisonInterface
{
    use SerializerTrait, DeserializerTrait;
    
    /**
     * @var FloatValue
     */
    public $longitude;
    
    /**
     * @var FloatValue
     */
    public $latitude;
    
    /**
     * Constructor.
     *
     * @param FloatValue $longitude
     * @param FloatValue $latitude
     */
    public function __construct(FloatValue $longitude, FloatValue $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return null === $this->longitude || null === $this->latitude;
    }
    
    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        return $value instanceof static 
            && $value->longitude->equal($this->longitude)
            && $value->latitude->equal($this->latitude);
    }
}
