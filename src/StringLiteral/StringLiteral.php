<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\StringLiteral;

use Borobudur\Serialization\StringInterface;
use Borobudur\Serialization\ValuableInterface;
use Borobudur\ValueObject\Comparison\ComparisonInterface;
use Borobudur\ValueObject\Comparison\ComparisonTrait;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class StringLiteral implements ValuableInterface, ComparisonInterface, StringInterface
{
    use ComparisonTrait;

    /**
     * @var string
     */
    protected $value;

    /**
     * Constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromString($value)
    {
        return new static($value);
    }

    /**
     * @param array  $parts
     * @param string $glue
     *
     * @return static
     */
    public static function implode(array $parts, $glue = '')
    {
        return new static(implode($glue, $parts));
    }

    /**
     * Match the value with regex.
     *
     * @param Regex $regex
     *
     * @return bool
     */
    public function match(Regex $regex)
    {
        return $regex->isMatch($this->value);
    }

    /**
     * Count length of current value.
     *
     * @return int
     */
    public function length()
    {
        return strlen($this->value);
    }

    /**
     * @param string $chars
     *
     * @return bool|int
     */
    public function charsAt($chars)
    {
        return strpos($this->value, $chars);
    }

    /**
     * @param string $search
     * @param string $replacer
     *
     * @return static
     */
    public function replace($search, $replacer)
    {
        return new static(str_replace($search, $replacer, $this->value));
    }

    /**
     * @param Regex  $regex
     * @param string $replacer
     *
     * @return static
     */
    public function replaceWithRegex(Regex $regex, $replacer)
    {
        return new static(preg_replace($regex->getValue(), $replacer, $this->value));
    }
    
    /**
     * @return static
     */
    public function uppercaseFirst()
    {
        return new static(ucfirst($this->value));
    }

    /**
     * @return static
     */
    public function lowercaseFirst()
    {
        return new static(lcfirst($this->value));
    }

    /**
     * @param string $chars
     *
     * @return static
     */
    public function trim($chars = " \t\n\r\0\x0B")
    {
        return new static(trim($this->value, $chars));
    }

    /**
     * @param string $chars
     *
     * @return static
     */
    public function leftTrim($chars = " \t\n\r\0\x0B")
    {
        return new static(ltrim($this->value, $chars));
    }

    /**
     * @param string $chars
     *
     * @return static
     */
    public function rightTrim($chars = " \t\n\r\0\x0B")
    {
        return new static(rtrim($this->value, $chars));
    }

    /**
     * @return static
     */
    public function toUpper()
    {
        return new static(strtoupper($this->value));
    }

    /**
     * @return static
     */
    public function toLower()
    {
        return new static(strtolower($this->value));
    }

    /**
     * @param int      $start
     * @param int|null $length
     *
     * @return static
     */
    public function substring($start, $length = null)
    {
        return new static(substr($this->value, $start, $length));
    }

    /**
     * @return static
     */
    public function reverse()
    {
        return new static(strrev($this->value));
    }

    /**
     * @param string   $delimiter
     * @param int|null $limit
     *
     * @return array
     */
    public function explode($delimiter, $limit = null)
    {
        return explode($delimiter, $this->value, $limit);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return empty($this->getValue());
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getValue();
    }
}
