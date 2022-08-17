<?php

namespace Unleash\Client\Bootstrap;

interface BootstrapHandler
{
    /**
     * @param \Unleash\Client\Bootstrap\BootstrapProvider $provider
     */
    public function getBootstrapContents($provider): ?string;
}
