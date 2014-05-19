<?php

namespace Acme\Event;

use Symfony\Component\EventDispatcher\Event;

use Acme\Bundle\DemoBundle\Entity\Shipment;

/**
 * Shipment status changed Event
 */
class ShipmentStatusChangedEvent extends Event
{
    /**
     * Shipment
     *
     * @var Shipment
     */
    protected $shipment;

    /**
     * Previous status
     *
     * @var string
     */
    protected $previousStatus;

    /**
     * Constructor
     *
     * @param Shipment $shipment
     * @param string $previousStatus
     */
    public function __construct(Shipment $shipment, $previousStatus = null)
    {
        $this->shipment       = $shipment;
        $this->previousStatus = $previousStatus;
    }

    /**
     * Get shipment
     *
     * @return Shipment
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Get current status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->shipment->getStatus();
    }

    /**
     * Get previous status
     *
     * @return string
     */
    public function getPreviousStatus()
    {
        return $this->previousStatus;
    }
}
