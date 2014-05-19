<?php

namespace Acme\Bundle\DemoBundle\EventListener;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Acme\ShipmentEvents;
use Acme\Service\ShipmentExporter;
use Acme\Event\ShipmentStatusChangedEvent;
use Acme\Bundle\DemoBundle\Entity\Shipment;

/**
 * Export Subscriber
 */
class ExportSubscriber implements EventSubscriberInterface
{
    /**
     * Shipment Exporter
     *
     * @var ShipmentExporter
     */
    protected $exporter;

    /**
     * Constructor
     *
     * @param ShipmentExporter $exporter
     */
    public function __construct(ShipmentExporter $exporter)
    {
        $this->exporter = $exporter;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ShipmentEvents::STATUS_CHANGED => 'onStatusChange',
            KernelEvents::TERMINATE        => 'onKernelTerminate',
        ];
    }

    /**
     * On status change
     *
     * @param ShipmentStatusChangedEvent $event
     */
    public function onStatusChange(ShipmentStatusChangedEvent $event)
    {
        $shipment = $event->getShipment();
        $status   = $event->getStatus();

        if ($event->getStatus() === Shipment::STATUS_ARRIVED) {
            $this->exporter->add($shipment);
        }
    }

    /**
     * On Kernel terminate
     */
    public function onKernelTerminate()
    {
        $this->exporter->flush();
    }
}