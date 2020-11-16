<?php

declare(strict_types=1);

namespace Juve534\Datadog\Client;

interface ClientInterface
{
    /**
     * @param string $path api path
     * @param array  $data optional data
     *
     * @return array api response
     */
    public function post(string $path, array $data = []): array;

    /**
     * @param string $path api path
     * @param array  $data optional data
     *
     * @return array api response
     */
    public function get(string $path, array $data = []): array;
}
