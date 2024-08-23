<?php

declare(strict_types=1);

namespace Petruchek\EuVat;

use Petruchek\EuVat\Geolocation\IP2C;
use Petruchek\EuVat\Geolocation\IP2Country;

class Geolocator
{
    private $services = [
        'ip2c.org' => IP2C::class,
        'ip2country.info' => IP2Country::class,
    ];

    /**
     * @var IP2Country|IP2C
     */
    private $service;

    public function __construct(string $service = 'ip2c.org')
    {
        if (!isset($this->services[$service])) {
            throw new \InvalidArgumentException("Invalid service {$service}");
        }

        $this->service = new $this->services[$service]();
    }

    public function locateIpAddress(string $ipAddress): string
    {
        if ($ipAddress === '') {
            return '';
        }

        return $this->service->locateIpAddress($ipAddress);
    }
}
