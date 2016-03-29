<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) MetroTV - MIS Department
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\DateTime;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\SerializableCasterTrait;
use DateTimeZone;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/28/16
 */
class DateTime implements SerializableInterface, DeserializableInterface, CastableInterface
{
    use SerializableCasterTrait;
    
    /**
     * {@inheritdoc}
     */
    public static function deserialize(array $attributes)
    {
        return new static($attributes['date'], new DateTimeZone($attributes['timezone']));
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return (array) $this;
    }
}
