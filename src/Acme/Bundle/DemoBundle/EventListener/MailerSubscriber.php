<?php

namespace Acme\Bundle\DemoBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Acme\ShipmentEvents;
use Acme\Service\ShipmentMailer;
use Acme\Event\ShipmentStatusChangedEvent;

/**
 * Mailer Subscriber
 */
class MailerSubscriber implements EventSubscriberInterface
{
    /**
     * Shipment Mailer
     *
     * @var ShipmentMailer
     */
    protected $mailer;

    /**
     * Constructor
     *
     * @param ShipmentExporter $exporter
     */
    public function __construct(ShipmentMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ShipmentEvents::STATUS_CHANGED => 'onStatusChange'
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
        $from     = $event->getPreviousStatus();
        $to       = $event->getStatus();

        $this->mailer->sendNotificationMail($shipment, $from, $to);
    }
}