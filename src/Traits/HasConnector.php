<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\GoWhatsAppConnector;

trait HasConnector
{
    /**
     * Resolve the GoWhatsAppConnector.
     * Uses local getConnector() if defined, otherwise resolves from Service Container.
     */
    protected function connector(): GoWhatsAppConnector
    {
        if (method_exists($this, 'getConnector')) {
             return $this->getConnector();
        }

        return app(GoWhatsAppConnector::class);
    }
}

