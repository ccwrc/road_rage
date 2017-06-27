<?php

namespace TruckBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct() {
        parent::__construct();

        $this->monitorings = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Monitoring", mappedBy="user")
     */
    private $monitorings;


    /**
     * Add monitorings
     *
     * @param \TruckBundle\Entity\Monitoring $monitorings
     * @return User
     */
    public function addMonitoring(\TruckBundle\Entity\Monitoring $monitorings)
    {
        $this->monitorings[] = $monitorings;

        return $this;
    }

    /**
     * Remove monitorings
     *
     * @param \TruckBundle\Entity\Monitoring $monitorings
     */
    public function removeMonitoring(\TruckBundle\Entity\Monitoring $monitorings)
    {
        $this->monitorings->removeElement($monitorings);
    }

    /**
     * Get monitorings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMonitorings()
    {
        return $this->monitorings;
    }
}
