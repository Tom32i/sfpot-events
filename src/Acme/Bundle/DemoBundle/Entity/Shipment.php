<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shipment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Shipment
{
    const STATUS_CREATED = 'created';
    const STATUS_SHIPED  = 'shiped';
    const STATUS_ARRIVED = 'arrived';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="string", length=10)
     */
    private $status;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->status = static::STATUS_CREATED;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status as Shiped
     */
    public function ship()
    {
        $this->status = static::STATUS_SHIPED;
    }

    /**
     * Set status as Arrived
     */
    public function receive()
    {
        $this->status = static::STATUS_ARRIVED;
    }
}
