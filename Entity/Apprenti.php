<?php

namespace ApprentisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apprenti
 *
 * @ORM\Table(name="apprenti", indexes={@ORM\Index(name="IDX_2CB7951C9510540E", columns={"app_ville"}), @ORM\Index(name="IDX_2CB7951C4145D04D", columns={"app_lieu_naissance"}), @ORM\Index(name="IDX_2CB7951C29A4CA79", columns={"app_titre"})})
 * @ORM\Entity(repositoryClass="ApprentisBundle\Repository\ApprentiRepository")
 */
class Apprenti
{
    /**
     * @var integer
     *
     * @ORM\Column(name="app_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="apprenti_app_id_seq", allocationSize=1, initialValue=1)
     */
    private $appId;

    /**
     * @var string
     *
     * @ORM\Column(name="app_nom", type="string", length=30, nullable=false)
     */
    private $appNom;

    /**
     * @var string
     *
     * @ORM\Column(name="app_prenom", type="string", length=30, nullable=false)
     */
    private $appPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="app_rue", type="string", length=50, nullable=false)
     */
    private $appRue;

    /**
     * @var string
     *
     * @ORM\Column(name="app_complement", type="string", length=50, nullable=true)
     */
    private $appComplement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="app_datenaissance", type="date", nullable=false)
     */
    private $appDatenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="app_telephone", type="string", length=10, nullable=false)
     */
    private $appTelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="app_mail", type="string", length=100, nullable=false)
     */
    private $appMail;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="app_ville", referencedColumnName="vil_id")
     * })
     */
    private $appVille;

    /**
     * @var \Ville
     *
     * @ORM\ManyToOne(targetEntity="Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="app_lieu_naissance", referencedColumnName="vil_id")
     * })
     */
    private $appLieuNaissance;

    /**
     * @var \Titre
     *
     * @ORM\ManyToOne(targetEntity="Titre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="app_titre", referencedColumnName="tit_id")
     * })
     */
    private $appTitre;


    /**
     * Get appId
     *
     * @return integer
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * Set appNom
     *
     * @param string $appNom
     *
     * @return Apprenti
     */
    public function setAppNom($appNom)
    {
        $this->appNom = $appNom;

        return $this;
    }

    /**
     * Get appNom
     *
     * @return string
     */
    public function getAppNom()
    {
        return $this->appNom;
    }

    /**
     * Set appPrenom
     *
     * @param string $appPrenom
     *
     * @return Apprenti
     */
    public function setAppPrenom($appPrenom)
    {
        $this->appPrenom = $appPrenom;

        return $this;
    }

    /**
     * Get appPrenom
     *
     * @return string
     */
    public function getAppPrenom()
    {
        return $this->appPrenom;
    }

    /**
     * Set appRue
     *
     * @param string $appRue
     *
     * @return Apprenti
     */
    public function setAppRue($appRue)
    {
        $this->appRue = $appRue;

        return $this;
    }

    /**
     * Get appRue
     *
     * @return string
     */
    public function getAppRue()
    {
        return $this->appRue;
    }

    /**
     * Set appComplement
     *
     * @param string $appComplement
     *
     * @return Apprenti
     */
    public function setAppComplement($appComplement)
    {
        $this->appComplement = $appComplement;

        return $this;
    }

    /**
     * Get appComplement
     *
     * @return string
     */
    public function getAppComplement()
    {
        return $this->appComplement;
    }

    /**
     * Set appDatenaissance
     *
     * @param \DateTime $appDatenaissance
     *
     * @return Apprenti
     */
    public function setAppDatenaissance($appDatenaissance)
    {
        $this->appDatenaissance = $appDatenaissance;

        return $this;
    }

    /**
     * Get appDatenaissance
     *
     * @return \DateTime
     */
    public function getAppDatenaissance()
    {
        return $this->appDatenaissance;
    }

    /**
     * Set appTelephone
     *
     * @param string $appTelephone
     *
     * @return Apprenti
     */
    public function setAppTelephone($appTelephone)
    {
        $this->appTelephone = $appTelephone;

        return $this;
    }

    /**
     * Get appTelephone
     *
     * @return string
     */
    public function getAppTelephone()
    {
        return $this->appTelephone;
    }

    /**
     * Set appMail
     *
     * @param string $appMail
     *
     * @return Apprenti
     */
    public function setAppMail($appMail)
    {
        $this->appMail = $appMail;

        return $this;
    }

    /**
     * Get appMail
     *
     * @return string
     */
    public function getAppMail()
    {
        return $this->appMail;
    }

    /**
     * Set appVille
     *
     * @param \ApprentisBundle\Entity\Ville $appVille
     *
     * @return Apprenti
     */
    public function setAppVille(\ApprentisBundle\Entity\Ville $appVille = null)
    {
        $this->appVille = $appVille;

        return $this;
    }

    /**
     * Get appVille
     *
     * @return \ApprentisBundle\Entity\Ville
     */
    public function getAppVille()
    {
        return $this->appVille;
    }

    /**
     * Set appLieuNaissance
     *
     * @param \ApprentisBundle\Entity\Ville $appLieuNaissance
     *
     * @return Apprenti
     */
    public function setAppLieuNaissance(\ApprentisBundle\Entity\Ville $appLieuNaissance = null)
    {
        $this->appLieuNaissance = $appLieuNaissance;

        return $this;
    }

    /**
     * Get appLieuNaissance
     *
     * @return \ApprentisBundle\Entity\Ville
     */
    public function getAppLieuNaissance()
    {
        return $this->appLieuNaissance;
    }

    /**
     * Set appTitre
     *
     * @param \ApprentisBundle\Entity\Titre $appTitre
     *
     * @return Apprenti
     */
    public function setAppTitre(\ApprentisBundle\Entity\Titre $appTitre = null)
    {
        $this->appTitre = $appTitre;

        return $this;
    }

    /**
     * Get appTitre
     *
     * @return \ApprentisBundle\Entity\Titre
     */
    public function getAppTitre()
    {
        return $this->appTitre;
    }

    
}
