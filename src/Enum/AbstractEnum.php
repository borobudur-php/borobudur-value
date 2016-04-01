<?php
/*
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Enum;

use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Caster\CastableInterface;
use Borobudur\ValueObject\Caster\ScalarCasterTrait;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;
use Borobudur\ValueObject\Exception\InvalidValueException;
use ReflectionClass;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/27/16
 */
abstract class AbstractEnum implements ValuableInterface, ComparisonInterface, CastableInterface
{
    use ComparisonTrait, ScalarCasterTrait;
    
    /**
     * @const mixed
     */
    const __DEFAULT = null;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param mixed|null $value
     *
     * @throws InvalidValueException
     */
    public function __construct($value = null)
    {
        if (null === static::__DEFAULT && null === $value) {
            throw new InvalidValueException(sprintf('Enum "%s" does not have default value.', static::getName()));
        }

        if (null === $value) {
            $value = static::__DEFAULT;
        }

        static::assertValid($value);
        $this->value = $value;
    }

    /**
     * Assert that value should valid.
     *
     * @param string $value
     *
     * @throws InvalidValueException
     */
    public static function assertValid($value)
    {
        if (false === static::isValid($value)) {
            throw new InvalidValueException(sprintf('"%s" not a const in enum "%s".', $value, static::getName()));
        }
    }

    /**
     * Check whatever value exist in constants.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public static function isValid($value)
    {
        return in_array($value, static::getValues());
    }

    /**
     * @return array
     */
    public static function getConstants()
    {
        return array_keys(static::getLists());
    }

    /**
     * @return array
     */
    public static function getValues()
    {
        return array_values(static::getLists());
    }

    /**
     * @return array
     */
    public static function getLists()
    {
        $constants = array();
        foreach (static::getReflection()->getConstants() as $field => $constant) {
            if ('__DEFAULT' !== $field) {
                $constants[$field] = $constant;
            }
        }

        return $constants;
    }

    /**
     * @param mixed $value
     *
     * @return int
     */
    public static function indexOf($value)
    {
        return array_search($value, static::getValues(), true);
    }

    /**
     * Get value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getOrdinal()
    {
        return static::indexOf($this->value);
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * @return string
     */
    protected static function getName()
    {
        return static::getReflection()->getShortName();
    }

    /**
     * @return ReflectionClass
     */
    protected static function getReflection()
    {
        return new ReflectionClass(get_called_class());
    }
}
