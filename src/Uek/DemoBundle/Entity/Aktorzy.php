<?php

namespace Uek\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aktorzy
 *
 * @ORM\Table(name="Aktorzy")
 * @ORM\Entity
 */
class Aktorzy
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdAktora", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaktora;

    /**
     * @var string
     *
     * @ORM\Column(name="NazwiskoAktora", type="string", length=255, nullable=true)
     */
    private $nazwiskoaktora;

    /**
     * @var string
     *
     * @ORM\Column(name="ImieAktora", type="string", length=255, nullable=true)
     */
    private $imieaktora;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Filmy", mappedBy="idaktora")
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
     * Get idaktora
     *
     * @return integer 
     */
    public function getIdaktora()
    {
        return $this->idaktora;
    }

    /**
     * Set nazwiskoaktora
     *
     * @param string $nazwiskoaktora
     * @return Aktorzy
     */
    public function setNazwiskoaktora($nazwiskoaktora)
    {
        $this->nazwiskoaktora = $nazwiskoaktora;

        return $this;
    }

    /**
     * Get nazwiskoaktora
     *
     * @return string 
     */
    public function getNazwiskoaktora()
    {
        return $this->nazwiskoaktora;
    }

    /**
     * Set imieaktora
     *
     * @param string $imieaktora
     * @return Aktorzy
     */
    public function setImieaktora($imieaktora)
    {
        $this->imieaktora = $imieaktora;

        return $this;
    }

    /**
     * Get imieaktora
     *
     * @return string 
     */
    public function getImieaktora()
    {
        return $this->imieaktora;
    }

    /**
     * Add idfilmu
     *
     * @param \Uek\DemoBundle\Entity\Filmy $idfilmu
     * @return Aktorzy
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
