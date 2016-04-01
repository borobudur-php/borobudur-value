<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Geography;

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
class Coordinate implements SerializableInterface, DeserializableInterface, ComparisonInterface, CastableInterface
{
    use SerializerTrait, DeserializerTrait, SerializableCasterTrait;
    
    /**
     * @var Longitude
     */
    public $longitude;
    
    /**
     * @var Latitude
     */
    public $latitude;
    
    /**
     * Constructor.
     *
     * @param Longitude $longitude
     * @param Latitude  $latitude
     */
    public function __construct(Longitude $longitude, Latitude $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return null === $this->longitude->isEmpty() && $this->latitude->isEmpty();
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
