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
        $manager  = $this->getDoctrine()->getManager();

        $manager->persist($shipment);
        $manager->flush();

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/ship/{id}", name="ship")
     */
    public function shipAction(Shipment $shipment)
    {
        $manager = $this->getDoctrine()->getManager();

        $shipment->setShiped();

        $manager->persist($shipment);
        $manager->flush();

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/receive/{id}", name="receive")
     */
    public function receiveAction(Shipment $shipment)
    {
        $manager = $this->getDoctrine()->getManager();

        $shipment->setArrived();

        $manager->persist($shipment);
        $manager->flush();

        return $this->redirect($this->generateUrl('index'));
    }
}
