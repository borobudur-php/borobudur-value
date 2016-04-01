<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Person;

use Borobudur\Serialization\DeserializableInterface;
use Borobudur\Serialization\SerializableInterface;
use Borobudur\Serialization\Serializer\Mixin\DeserializerTrait;
use Borobudur\Serialization\Serializer\Mixin\SerializerTrait;
use Borobudur\Serialization\StringInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\StringLiteral\StringLiteral;
use ReflectionClass;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Name
    implements SerializableInterface, DeserializableInterface, ComparisonInterface, StringInterface, CastableInterface
{
    use SerializerTrait, DeserializerTrait;

    /**
     * @var StringLiteral
     */
    public $first;

    /**
     * @var StringLiteral
     */
    public $middle;

    /**
     * @var StringLiteral
     */
    public $last;

    /**
     * Constructor.
     *
     * @param StringLiteral $first
     * @param StringLiteral $middle
     * @param StringLiteral $last
     */
    public function __construct(StringLiteral $first, StringLiteral $middle = null, StringLiteral $last = null)
    {
        $this->first = $first;
        $this->middle = $middle;
        $this->last = $last;
    }

    /**
     * {@inheritdoc}
     */
    public static function cast($value)
    {
        return (new ReflectionClass(get_called_class()))->newInstanceArgs(static::mapFromString(func_get_args()));
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->first->isEmpty()
            && $this->middle->isEmpty()
            && $this->last->isEmpty();
    }

    /**
     * @return StringLiteral
     */
    public function getFullName()
    {
        $parts = array_filter(array((string) $this->first, (string)$this->middle, (string) $this->last));

        return new StringLiteral(implode(' ', $parts));
    }

    /**
     * {@inheritdoc}
     */
    public function equal($value)
    {
        if ($value instanceof static) {
            return $value->getFullName()->equal($this->getFullName());
        }

        return false;
    }

    /**
     * Build object from string.
     *
     * @param string $name
     *
     * @return static
     */
    public static function fromString($name)
    {
        return call_user_func_array(array('static', 'cast'), static::fromStringToArray($name));
    }

    /**
     * Convert the object to string.
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getFullName();
    }

    /**
     * @param string $name
     *
     * @return $names
     */
    protected static function fromStringToArray($name)
    {
        $parts = explode(' ', $name);
        $names = $parts;
        if (count($parts) > 1) {
            if (count($parts) === 2) {
                $names[1] = null;
                $names[2] = $parts[1];
            }
        }

        return $names;
    }

    /**
     * @param array $arguments
     *
     * @return array
     */
    protected static function mapFromString(array $arguments)
    {
        return array_map(function($name) {
            return StringLiteral::fromString($name ? $name : null);
        }, $arguments);
    }
}
