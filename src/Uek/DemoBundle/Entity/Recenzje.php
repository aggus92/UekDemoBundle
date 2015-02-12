<?php

namespace Uek\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recenzje
 *
 * @ORM\Table(name="Recenzje", indexes={@ORM\Index(name="IdFilmu", columns={"IdFilmu"})})
 * @ORM\Entity
 */
class Recenzje
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdRecenzji", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecenzji;

    /**
     * @var string
     *
     * @ORM\Column(name="Tresc", type="text", length=65535, nullable=true)
     */
    private $tresc;

    /**
     * @var string
     *
     * @ORM\Column(name="Autor", type="string", length=255, nullable=true)
     */
    private $autor;

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
     * Get idrecenzji
     *
     * @return integer 
     */
    public function getIdrecenzji()
    {
        return $this->idrecenzji;
    }

    /**
     * Set tresc
     *
     * @param string $tresc
     * @return Recenzje
     */
    public function setTresc($tresc)
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Get tresc
     *
     * @return string 
     */
    public function getTresc()
    {
        return $this->tresc;
    }

    /**
     * Set autor
     *
     * @param string $autor
     * @return Recenzje
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return string 
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set idfilmu
     *
     * @param \Uek\DemoBundle\Entity\Filmy $idfilmu
     * @return Recenzje
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
