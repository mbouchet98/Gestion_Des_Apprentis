<?php

namespace ApprentisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ville
 *
 * @ORM\Table(name="ville", uniqueConstraints={@ORM\UniqueConstraint(name="uk_CP_LIB", columns={"vil_cp", "vil_libelle"})}, indexes={@ORM\Index(name="tri_ville", columns={"vil_cp"})})
 * @ORM\Entity
 */
class Ville
{
    /**
     * @var integer
     *
     * @ORM\Column(name="vil_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ville_vil_id_seq", allocationSize=1, initialValue=1)
     */
    private $vilId;

    /**
     * @var string
     *
     * @ORM\Column(name="vil_cp", type="string", length=5, nullable=false)
     */
    private $vilCp;

    /**
     * @var string
     *
     * @ORM\Column(name="vil_libelle", type="string", length=50, nullable=false)
     */
    private $vilLibelle;



    /**
     * Get vilId
     *
     * @return integer
     */
    public function getVilId()
    {
        return $this->vilId;
    }

    /**
     * Set vilCp
     *
     * @param string $vilCp
     *
     * @return Ville
     */
    public function setVilCp($vilCp)
    {
        $this->vilCp = $vilCp;

        return $this;
    }

    /**
     * Get vilCp
     *
     * @return string
     */
    public function getVilCp()
    {
        return $this->vilCp;
    }

    /**
     * Set vilLibelle
     *
     * @param string $vilLibelle
     *
     * @return Ville
     */
    public function setVilLibelle($vilLibelle)
    {
        $this->vilLibelle = $vilLibelle;

        return $this;
    }

    /**
     * Get vilLibelle
     *
     * @return string
     */

    public function getVilLibelle()
    {
        return $this->vilLibelle;
    }
}
