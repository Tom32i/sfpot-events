<?php

namespace Acme\Bundle\DemoBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Acme\Bundle\DemoBundle\Entity\Shipment;
use Acme\Event\ShipmentStatusChangedEvent;
use Acme\ShipmentEvents;

/**
 * Doctrine Subscriber
 */
class DoctrineSubscriber implements EventSubscriber
{
    /**
     *  Event Dispatcher
     *
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * Queued events
     *
     * @var array
     */
    protected $queue;

    /**
     * Constructor
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->queue      = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            'preUpdate',
            'postPersist',
            'postFlush',
        ];
    }

    /**
     * Post update
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Shipment && $args->hasChangedField('status')) {
            $this->queue[] = [
                'name'   => ShipmentEvents::STATUS_CHANGED,
                'object' => new ShipmentStatusChangedEvent($entity, $args->getOldValue('status'))
            ];
        }
    }

    /**
     * Post persist
     *
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Shipment) {
            $this->queue[] = [
                'name'   => ShipmentEvents::STATUS_CHANGED,
                'object' => new ShipmentStatusChangedEvent($entity)
            ];
        }
    }

    /**
     * Post flush
     *
     * @param PostFlushEventArgs $args
     */
    public function postFlush(PostFlushEventArgs $args)
    {
        $this->dispatchEvents();
    }

    /**
     * Dispatch queued events
     */
    protected function dispatchEvents()
    {
        foreach ($this->queue as $event) {
            $this->dispatcher->dispatch($event['name'], $event['object']);
        }
    }
}
