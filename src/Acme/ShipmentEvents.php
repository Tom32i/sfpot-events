<?php

namespace Acme;

/**
 * Shipment related events
 */
final class ShipmentEvents
{
    /**
     * Triggered when the status of a shipment changes.
     *
     * The event listener receives an
     * Acme\Event\ShipmentStatusChangedEvent instance.
     *
     * @var string
     */
    const STATUS_CHANGED = 'shipment.status_changed';
}