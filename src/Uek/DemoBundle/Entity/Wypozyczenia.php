<?php

namespace Uek\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wypozyczenia
 *
 * @ORM\Table(name="Wypozyczenia", indexes={@ORM\Index(name="IdUzytkownika", columns={"IdUzytkownika"}), @ORM\Index(name="IdFilmu", columns={"IdFilmu"})})
 * @ORM\Entity
 */
class Wypozyczenia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IdWypozyczenia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idwypozyczenia;

    /**
     * @var \FosUser
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdUzytkownika", referencedColumnName="id")
     * })
     */
    private $iduzytkownika;

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
     * Get idwypozyczenia
     *
     * @return integer 
     */
    public function getIdwypozyczenia()
    {
        return $this->idwypozyczenia;
    }

    /**
     * Set iduzytkownika
     *
     * @param \Uek\DemoBundle\Entity\FosUser $iduzytkownika
     * @return Wypozyczenia
     */
    public function setIduzytkownika(\Uek\DemoBundle\Entity\User $iduzytkownika = null)
    {
        $this->iduzytkownika = $iduzytkownika;

        return $this;
    }

    /**
     * Get iduzytkownika
     *
     * @return \Uek\DemoBundle\Entity\FosUser 
     */
    public function getIduzytkownika()
    {
        return $this->iduzytkownika;
    }

    /**
     * Set idfilmu
     *
     * @param \Uek\DemoBundle\Entity\Filmy $idfilmu
     * @return Wypozyczenia
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
