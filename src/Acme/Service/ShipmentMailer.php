<?php

namespace Acme\Service;

use Psr\Log\LoggerInterface;

use Acme\Bundle\DemoBundle\Entity\Shipment;

/**
 * Shipment Mailer
 */
class ShipmentMailer
{
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
    }

    /**
     * Export a shipment
     *
     * @param Shipment $shipment
     *
     * @return boolean Result
     */
    public function sendNotificationMail(Shipment $shipment, $from, $to)
    {
        $message = "Sending mail: shipment #%d changed from %s to %s";

        $this->logger->info(sprintf($message, $shipment->getId(), $from, $to));
    }
}