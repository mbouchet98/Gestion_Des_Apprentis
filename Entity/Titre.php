<?php

namespace ApprentisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titre
 *
 * @ORM\Table(name="titre", uniqueConstraints={@ORM\UniqueConstraint(name="titre_tit_libelle_key", columns={"tit_libelle"})})
 * @ORM\Entity
 */
class Titre
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="titre_tit_id_seq", allocationSize=1, initialValue=1)
     */
    private $titId;

    /**
     * @var string
     *
     * @ORM\Column(name="tit_libelle", type="string", length=10, nullable=false)
     */
    private $titLibelle;



    /**
     * Get titId
     *
     * @return integer
     */
    public function getTitId()
    {
        return $this->titId;
    }

    /**
     * Set titLibelle
     *
     * @param string $titLibelle
     *
     * @return Titre
     */
    public function setTitLibelle($titLibelle)
    {
        $this->titLibelle = $titLibelle;

        return $this;
    }

    /**
     * Get titLibelle
     *
     * @return string
     */
    public function getTitLibelle()
    {
        return $this->titLibelle;
    }
}
