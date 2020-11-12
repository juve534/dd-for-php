<?php

declare(strict_types=1);

namespace Juve534\Datadog\Client;

interface ClientInterface
{
    public function post(string $path, array $data = []): array;
}
