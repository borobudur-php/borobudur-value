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

/**
 * @author      Iqbal Maulana <iq.bluejack@gmail.com>
 * @created     3/29/16
 */
class Domain
{
    /**
     * Constructor.
     */
    private function __constructor()
    {
        // Protect constructor.
    }

    /**
     * Specify the domain is ip address or hostname.
     *
     * @param string $domain
     *
     * @return Hostname|IPv4Address|IPv6Address
     */
    public function specify($domain)
    {
        if (true === filter_var($domain, FILTER_VALIDATE_IP)) {
            return IPAddress::specify($domain);
        }

        return Hostname::fromString($domain);
    }
}
