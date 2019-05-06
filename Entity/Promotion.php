<?php

namespace ApprentisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity
 */
class Promotion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="pro_promotion", type="integer", nullable=false)
     * @ORM\Id
     */
    private $proPromotion;

    /**
	* @ORM\ManyToMany(targetEntity="Apprenti", cascade={"persist"})
	* @ORM\JoinTable(name="inscription",
	* joinColumns={@ORM\JoinColumn(name="ins_promotion",referencedColumnName="pro_promotion")},
	* inverseJoinColumns={@ORM\JoinColumn(name="ins_apprenti",referencedColumnName="app_id")})
    */
    private $insApprenti;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->insApprenti = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get proPromotion
     *
     * @return integer
     */
    public function getProPromotion()
    {
        return $this->proPromotion;
    }
	
	 /**
     * Set proPromotion
     *
     * @param integer $proPromotion
     *
     * @return Promotion
     */
    public function setProPromotion($proPromotion)
    {
        $this->proPromotion = $proPromotion;

        return $this;
    }

    /**
     * Add insApprenti
     *
     * @param \ApprentisBundle\Entity\Apprenti $insApprenti
     *
     * @return Promotion
     */
    public function addInsApprenti(\ApprentisBundle\Entity\Apprenti $insApprenti)
    {
        $this->insApprenti[] = $insApprenti;

        //return $this;
    }

    /**
     * Remove insApprenti
     *
     * @param \ApprentisBundle\Entity\Apprenti $insApprenti
     */
    public function removeInsApprenti(\ApprentisBundle\Entity\Apprenti $insApprenti)
    {
        $this->insApprenti->removeElement($insApprenti);
    }

    /**
     * Get insApprenti
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInsApprenti()
    {
        return $this->insApprenti;
    }
}
