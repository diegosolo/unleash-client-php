<?php

namespace Unleash\Client\Bootstrap;

interface BootstrapHandler
{
    /**
     * @param \Unleash\Client\Bootstrap\BootstrapProvider $provider
     * @return string|null
     */
    public function getBootstrapContents($provider);
}
