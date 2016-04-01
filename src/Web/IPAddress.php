<?php
/**
 * This file is part of the Borobudur-ValueObject package.
 *
 * (c) Hexacodelabs <http://hexacodelabs.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Borobudur\ValueObject\Web;

use Borobudur\ValueObject\Exception\InvalidValueException;

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class IPAddress
{
    /**
     * Constructor.
     */
    private function __construct()
    {
        // Protect constructor.
    }
    
    /**
     * Specify the ip address.
     *
     * @param string $ipAddress
     *
     * @return IPv4Address|IPv6Address
     * @throws InvalidValueException
     */
    public static function specify($ipAddress)
    {
        if (true === filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return IPv4Address::fromString($ipAddress);
        }
        
        if (true === filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return IPv6Address::fromString($ipAddress);
        }
        
        throw InvalidValueException::invalidValueType($ipAddress, array('string (valid ip4 or ip6 address)'));
    }
}
