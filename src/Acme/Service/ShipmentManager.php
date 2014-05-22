<?php

namespace Acme\Service;

use Psr\Log\LoggerInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\Bundle\DemoBundle\Entity\Shipment;

/**
 * Shipment Manager
 */
class ShipmentManager
{
    /**
     * Object Manager
     *
     * @var ObjectManager
     */
    protected $manager;

    /**
     * Shipment Repository
     *
     * @var EntityRepository
     */
    protected $repositoy;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager   = $manager;
        $this->repositoy = $manager->getRepository('AcmeDemoBundle:Shipment');
    }

    /**
     * Get all shipments
     *
     * @return array
     */
    public function getShipments()
    {
        return $this->repositoy->findAll();
    }

    /**
     * Create a shipment
     *
     * @param Shipment $shipment
     */
    public function create(Shipment $shipment)
    {
        $this->persist($shipment);
    }

    /**
     * Ship a shipment
     *
     * @param Shipment $shipment
     */
    public function ship(Shipment $shipment)
    {
        $shipment->ship();
        $this->persist($shipment);
    }

    /**
     * Receive a shipment
     *
     * @param Shipment $shipment
     */
    public function receive(Shipment $shipment)
    {
        $shipment->receive();
        $this->persist($shipment);
    }

    /**
     * Persist a Shipment
     *
     * @param Shipment $shipment
     */
    protected function persist(Shipment $shipment)
    {
        $this->manager->persist($shipment);
        $this->manager->flush();
    }
}