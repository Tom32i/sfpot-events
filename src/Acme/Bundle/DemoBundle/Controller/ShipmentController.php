<?php

namespace Acme\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\Bundle\DemoBundle\Entity\Shipment;

/**
 * Shipment Controller
 */
class ShipmentController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $shipments = $this->getDoctrine()->getRepository('AcmeDemoBundle:Shipment')->findAll();

        return ['shipments' => $shipments];
    }

    /**
     * @Route("/new", name="new")
     */
    public function newAction()
    {
        $shipment = new Shipment();

        $this->persist($shipment);

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/ship/{id}", name="ship")
     */
    public function shipAction(Shipment $shipment)
    {
        $shipment->ship();

        $this->persist($shipment);

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/receive/{id}", name="receive")
     */
    public function receiveAction(Shipment $shipment)
    {
        $shipment->receive();

        $this->persist($shipment);

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * Persist a Shipment
     *
     * @param Shipment $shipment
     */
    protected function persist(Shipment $shipment)
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->persist($shipment);
        $manager->flush();
    }
}
