<?php

namespace Uek\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filmy
 *
 * @ORM\Table(name="Filmy")
 * @ORM\Entity
 */
class Filmy
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdFilmu", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfilmu;

    /**
     * @var string
     *
     * @ORM\Column(name="TytulFilmu", type="string", length=255, nullable=false)
     */
    private $tytulfilmu;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="text", length=65535, nullable=true)
     */
    private $opis;

    /**
     * @var float
     *
     * @ORM\Column(name="oplata", type="float", precision=10, scale=0, nullable=true)
     */
    private $oplata;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Aktorzy", inversedBy="idfilmu")
     * @ORM\JoinTable(name="filmyaktorzy",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdFilmu", referencedColumnName="IdFilmu")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IdAktora", referencedColumnName="IdAktora")
     *   }
     * )
     */
    private $idaktora;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Gatunki", inversedBy="idfilmu")
     * @ORM\JoinTable(name="filmygatunki",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdFilmu", referencedColumnName="IdFilmu")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Gatunek", referencedColumnName="Gatunek")
     *   }
     * )
     */
    private $gatunek;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idaktora = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gatunek = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get idfilmu
     *
     * @return integer 
     */
    public function getIdfilmu()
    {
        return $this->idfilmu;
    }

    /**
     * Set tytulfilmu
     *
     * @param string $tytulfilmu
     * @return Filmy
     */
    public function setTytulfilmu($tytulfilmu)
    {
        $this->tytulfilmu = $tytulfilmu;

        return $this;
    }

    /**
     * Get tytulfilmu
     *
     * @return string 
     */
    public function getTytulfilmu()
    {
        return $this->tytulfilmu;
    }

    /**
     * Set opis
     *
     * @param string $opis
     * @return Filmy
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string 
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set oplata
     *
     * @param float $oplata
     * @return Filmy
     */
    public function setOplata($oplata)
    {
        $this->oplata = $oplata;

        return $this;
    }

    /**
     * Get oplata
     *
     * @return float 
     */
    public function getOplata()
    {
        return $this->oplata;
    }

    /**
     * Add idaktora
     *
     * @param \Uek\DemoBundle\Entity\Aktorzy $idaktora
     * @return Filmy
     */
    public function addIdaktora(\Uek\DemoBundle\Entity\Aktorzy $idaktora)
    {
        $this->idaktora[] = $idaktora;

        return $this;
    }

    /**
     * Remove idaktora
     *
     * @param \Uek\DemoBundle\Entity\Aktorzy $idaktora
     */
    public function removeIdaktora(\Uek\DemoBundle\Entity\Aktorzy $idaktora)
    {
        $this->idaktora->removeElement($idaktora);
    }

    /**
     * Get idaktora
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdaktora()
    {
        return $this->idaktora;
    }

    /**
     * Add gatunek
     *
     * @param \Uek\DemoBundle\Entity\Gatunki $gatunek
     * @return Filmy
     */
    public function addGatunek(\Uek\DemoBundle\Entity\Gatunki $gatunek)
    {
        $this->gatunek[] = $gatunek;

        return $this;
    }

    /**
     * Remove gatunek
     *
     * @param \Uek\DemoBundle\Entity\Gatunki $gatunek
     */
    public function removeGatunek(\Uek\DemoBundle\Entity\Gatunki $gatunek)
    {
        $this->gatunek->removeElement($gatunek);
    }

    /**
     * Get gatunek
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGatunek()
    {
        return $this->gatunek;
    }
}
