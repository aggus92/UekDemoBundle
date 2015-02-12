<?php

namespace Uek\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gatunki
 *
 * @ORM\Table(name="Gatunki")
 * @ORM\Entity
 */
class Gatunki
{
    /**
     * @var string
     *
     * @ORM\Column(name="Gatunek", type="string", length=15, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $gatunek;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Filmy", mappedBy="gatunek")
     */
    private $idfilmu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idfilmu = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get gatunek
     *
     * @return string 
     */
    public function getGatunek()
    {
        return $this->gatunek;
    }

    /**
     * Add idfilmu
     *
     * @param \Uek\DemoBundle\Entity\Filmy $idfilmu
     * @return Gatunki
     */
    public function addIdfilmu(\Uek\DemoBundle\Entity\Filmy $idfilmu)
    {
        $this->idfilmu[] = $idfilmu;

        return $this;
    }

    /**
     * Remove idfilmu
     *
     * @param \Uek\DemoBundle\Entity\Filmy $idfilmu
     */
    public function removeIdfilmu(\Uek\DemoBundle\Entity\Filmy $idfilmu)
    {
        $this->idfilmu->removeElement($idfilmu);
    }

    /**
     * Get idfilmu
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdfilmu()
    {
        return $this->idfilmu;
    }
}
