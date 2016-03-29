<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\Serializer\Mixin\DeserializerTrait;
use Borobudur\Serialization\Serializer\Mixin\SerializerTrait;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\SerializableCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
class Location implements SerializableInterface, DeserializableInterface, ComparisonInterface, CastableInterface
{
    use SerializerTrait, DeserializerTrait, SerializableCasterTrait;
    
    /**
     * @var float
     */
    public $longitude;
    
    /**
     * @var float
     */
    public $latitude;
    
    /**
     * Constructor.
     *
     * @param float $longitude
     * @param float $latitude
     */
    public function __construct($longitude, $latitude)
    {
        $this->longitude = (float) $longitude;
        $this->latitude = (float) $latitude;
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
            && $value->longitude === $this->longitude
            && $value->latitude === $this->latitude;
    }
}
