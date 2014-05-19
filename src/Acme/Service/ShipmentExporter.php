<?php

namespace Acme\Service;

use Psr\Log\LoggerInterface;

use Acme\Bundle\DemoBundle\Entity\Shipment;

/**
 * Shipment Exporter
 */
class ShipmentExporter
{
    /**
     * Queue
     *
     * @var Shipment[]
     */
    protected $queue;

    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->queue  = [];
    }

    /**
     * Add a Shipment to the export queue
     *
     * @param Shipment $shipment
     */
    public function add(Shipment $shipment)
    {
        $this->queue[] = $shipment;
    }

    /**
     * Export all queued Shipments
     */
    public function flush()
    {
        foreach ($this->queue as $shipment) {
            $this->export($shipment);
        }
    }

    /**
     * Export a shipment
     *
     * @param Shipment $shipment
     *
     * @return boolean Result
     */
    protected function export(Shipment $shipment)
    {
        $this->logger->info(sprintf("Exported shipment #%d.", $shipment->getId()));
    }
}