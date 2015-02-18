<?php

namespace Uek\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Koszyk
 *
 * @ORM\Table(name="Koszyk", indexes={@ORM\Index(name="IdFilmu", columns={"IdFilmu"})})
 * @ORM\Entity
 */
class Koszyk
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdKoszyka", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idkoszyka;

    /**
     * @var string
     *
     * @ORM\Column(name="Uzytkownik", type="string", length=255, nullable=true)
     */
    private $uzytkownik;

    /**
     * @var \Filmy
     *
     * @ORM\ManyToOne(targetEntity="Filmy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdFilmu", referencedColumnName="IdFilmu")
     * })
     */
    private $idfilmu;

    /**
     * Get idkoszyka
     *
     * @return integer 
     */
    public function getIdkoszyka()
    {
        return $this->idkoszyka;
    }

    /**
     * Set uzytkownik
     *
     * @param string $uzytkownik
     * @return Koszyk
     */
    public function setUzytkownik($uzytkownik)
    {
        $this->uzytkownik = $uzytkownik;

        return $this;
    }

    /**
     * Get uzytkownik
     *
     * @return string
     */
    public function getUzytkownik()
    {
        return $this->uzytkownik;
    }

    /**
     * Set idfilmu
     *
     * @param \Uek\DemoBundle\Entity\Filmy $idfilmu
     * @return Koszyk
     */
    public function setIdfilmu(\Uek\DemoBundle\Entity\Filmy $idfilmu = null)
    {
        $this->idfilmu = $idfilmu;

        return $this;
    }

    /**
     * Get idfilmu
     *
     * @return \Uek\DemoBundle\Entity\Filmy 
     */
    public function getIdfilmu()
    {
        return $this->idfilmu;
    }
}
