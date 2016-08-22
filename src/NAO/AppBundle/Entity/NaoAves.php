<?php

namespace NAO\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NaoAves
 *
 * @ORM\Table(name="nao_aves")
 * @ORM\Entity(repositoryClass="NAO\AppBundle\Repository\NaoAvesRepository")
 */
class NaoAves
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="REGNE", type="string", length=8, nullable=true)
     */
    private $regne;

    /**
     * @var string
     *
     * @ORM\Column(name="PHYLUM", type="string", length=8, nullable=true)
     */
    private $phylum;

    /**
     * @var string
     *
     * @ORM\Column(name="CLASSE", type="string", length=4, nullable=true)
     */
    private $classe;

    /**
     * @var string
     *
     * @ORM\Column(name="ORDRE", type="string", length=16, nullable=true)
     */
    private $ordre;

    /**
     * @var string
     *
     * @ORM\Column(name="FAMILLE", type="string", length=17, nullable=true)
     */
    private $famille;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_NOM", type="integer", nullable=true)
     */
    private $cdNom;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_TAXSUP", type="integer", nullable=true)
     */
    private $cdTaxsup;

    /**
     * @var integer
     *
     * @ORM\Column(name="CD_REF", type="integer", nullable=true)
     */
    private $cdRef;

    /**
     * @var string
     *
     * @ORM\Column(name="RANG", type="string", length=4, nullable=true)
     */
    private $rang;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_NOM", type="string", length=47, nullable=true)
     */
    private $lbNom;

    /**
     * @var string
     *
     * @ORM\Column(name="LB_AUTEUR", type="string", length=41, nullable=true)
     */
    private $lbAuteur;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_COMPLET", type="string", length=69, nullable=true)
     */
    private $nomComplet;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VALIDE", type="string", length=66, nullable=true)
     */
    private $nomValide;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN", type="text", length=16777215, nullable=true)
     */
    private $nomVern;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM_VERN_ENG", type="string", length=120, nullable=true)
     */
    private $nomVernEng;

    /**
     * @var string
     *
     * @ORM\Column(name="HABITAT", type="string", length=1, nullable=true)
     */
    private $habitat;

    /**
     * @var string
     *
     * @ORM\Column(name="FR", type="string", length=1, nullable=true)
     */
    private $fr;

    /**
     * @var string
     *
     * @ORM\Column(name="GF", type="string", length=1, nullable=true)
     */
    private $gf;

    /**
     * @var string
     *
     * @ORM\Column(name="MAR", type="string", length=1, nullable=true)
     */
    private $mar;

    /**
     * @var string
     *
     * @ORM\Column(name="GUA", type="string", length=1, nullable=true)
     */
    private $gua;

    /**
     * @var string
     *
     * @ORM\Column(name="SM", type="string", length=1, nullable=true)
     */
    private $sm;

    /**
     * @var string
     *
     * @ORM\Column(name="SB", type="string", length=1, nullable=true)
     */
    private $sb;

    /**
     * @var string
     *
     * @ORM\Column(name="SPM", type="string", length=1, nullable=true)
     */
    private $spm;

    /**
     * @var string
     *
     * @ORM\Column(name="MAY", type="string", length=1, nullable=true)
     */
    private $may;

    /**
     * @var string
     *
     * @ORM\Column(name="EPA", type="string", length=1, nullable=true)
     */
    private $epa;

    /**
     * @var string
     *
     * @ORM\Column(name="REU", type="string", length=1, nullable=true)
     */
    private $reu;

    /**
     * @var string
     *
     * @ORM\Column(name="TAAF", type="string", length=1, nullable=true)
     */
    private $taaf;

    /**
     * @var string
     *
     * @ORM\Column(name="NC", type="string", length=1, nullable=true)
     */
    private $nc;

    /**
     * @var string
     *
     * @ORM\Column(name="WF", type="string", length=1, nullable=true)
     */
    private $wf;

    /**
     * @var string
     *
     * @ORM\Column(name="PF", type="string", length=6, nullable=true)
     */
    private $pf;

    /**
     * @var string
     *
     * @ORM\Column(name="CLI", type="string", length=6, nullable=true)
     */
    private $cli;

    /**
     * @var string
     *
     * @ORM\Column(name="APHIA_ID", type="string", length=6, nullable=true)
     */
    private $aphiaId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set regne
     *
     * @param string $regne
     *
     * @return NaoAves
     */
    public function setRegne($regne)
    {
        $this->regne = $regne;

        return $this;
    }

    /**
     * Get regne
     *
     * @return string
     */
    public function getRegne()
    {
        return $this->regne;
    }

    /**
     * Set phylum
     *
     * @param string $phylum
     *
     * @return NaoAves
     */
    public function setPhylum($phylum)
    {
        $this->phylum = $phylum;

        return $this;
    }

    /**
     * Get phylum
     *
     * @return string
     */
    public function getPhylum()
    {
        return $this->phylum;
    }

    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return NaoAves
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set ordre
     *
     * @param string $ordre
     *
     * @return NaoAves
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return string
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * Set famille
     *
     * @param string $famille
     *
     * @return NaoAves
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set cdNom
     *
     * @param integer $cdNom
     *
     * @return NaoAves
     */
    public function setCdNom($cdNom)
    {
        $this->cdNom = $cdNom;

        return $this;
    }

    /**
     * Get cdNom
     *
     * @return integer
     */
    public function getCdNom()
    {
        return $this->cdNom;
    }

    /**
     * Set cdTaxsup
     *
     * @param integer $cdTaxsup
     *
     * @return NaoAves
     */
    public function setCdTaxsup($cdTaxsup)
    {
        $this->cdTaxsup = $cdTaxsup;

        return $this;
    }

    /**
     * Get cdTaxsup
     *
     * @return integer
     */
    public function getCdTaxsup()
    {
        return $this->cdTaxsup;
    }

    /**
     * Set cdRef
     *
     * @param integer $cdRef
     *
     * @return NaoAves
     */
    public function setCdRef($cdRef)
    {
        $this->cdRef = $cdRef;

        return $this;
    }

    /**
     * Get cdRef
     *
     * @return integer
     */
    public function getCdRef()
    {
        return $this->cdRef;
    }

    /**
     * Set rang
     *
     * @param string $rang
     *
     * @return NaoAves
     */
    public function setRang($rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Get rang
     *
     * @return string
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Set lbNom
     *
     * @param string $lbNom
     *
     * @return NaoAves
     */
    public function setLbNom($lbNom)
    {
        $this->lbNom = $lbNom;

        return $this;
    }

    /**
     * Get lbNom
     *
     * @return string
     */
    public function getLbNom()
    {
        return $this->lbNom;
    }

    /**
     * Set lbAuteur
     *
     * @param string $lbAuteur
     *
     * @return NaoAves
     */
    public function setLbAuteur($lbAuteur)
    {
        $this->lbAuteur = $lbAuteur;

        return $this;
    }

    /**
     * Get lbAuteur
     *
     * @return string
     */
    public function getLbAuteur()
    {
        return $this->lbAuteur;
    }

    /**
     * Set nomComplet
     *
     * @param string $nomComplet
     *
     * @return NaoAves
     */
    public function setNomComplet($nomComplet)
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    /**
     * Get nomComplet
     *
     * @return string
     */
    public function getNomComplet()
    {
        return $this->nomComplet;
    }

    /**
     * Set nomValide
     *
     * @param string $nomValide
     *
     * @return NaoAves
     */
    public function setNomValide($nomValide)
    {
        $this->nomValide = $nomValide;

        return $this;
    }

    /**
     * Get nomValide
     *
     * @return string
     */
    public function getNomValide()
    {
        return $this->nomValide;
    }

    /**
     * Set nomVern
     *
     * @param string $nomVern
     *
     * @return NaoAves
     */
    public function setNomVern($nomVern)
    {
        $this->nomVern = $nomVern;

        return $this;
    }

    /**
     * Get nomVern
     *
     * @return string
     */
    public function getNomVern()
    {
        return $this->nomVern;
    }

    /**
     * Set nomVernEng
     *
     * @param string $nomVernEng
     *
     * @return NaoAves
     */
    public function setNomVernEng($nomVernEng)
    {
        $this->nomVernEng = $nomVernEng;

        return $this;
    }

    /**
     * Get nomVernEng
     *
     * @return string
     */
    public function getNomVernEng()
    {
        return $this->nomVernEng;
    }

    /**
     * Set habitat
     *
     * @param string $habitat
     *
     * @return NaoAves
     */
    public function setHabitat($habitat)
    {
        $this->habitat = $habitat;

        return $this;
    }

    /**
     * Get habitat
     *
     * @return string
     */
    public function getHabitat()
    {
        return $this->habitat;
    }

    /**
     * Set fr
     *
     * @param string $fr
     *
     * @return NaoAves
     */
    public function setFr($fr)
    {
        $this->fr = $fr;

        return $this;
    }

    /**
     * Get fr
     *
     * @return string
     */
    public function getFr()
    {
        return $this->fr;
    }

    /**
     * Set gf
     *
     * @param string $gf
     *
     * @return NaoAves
     */
    public function setGf($gf)
    {
        $this->gf = $gf;

        return $this;
    }

    /**
     * Get gf
     *
     * @return string
     */
    public function getGf()
    {
        return $this->gf;
    }

    /**
     * Set mar
     *
     * @param string $mar
     *
     * @return NaoAves
     */
    public function setMar($mar)
    {
        $this->mar = $mar;

        return $this;
    }

    /**
     * Get mar
     *
     * @return string
     */
    public function getMar()
    {
        return $this->mar;
    }

    /**
     * Set gua
     *
     * @param string $gua
     *
     * @return NaoAves
     */
    public function setGua($gua)
    {
        $this->gua = $gua;

        return $this;
    }

    /**
     * Get gua
     *
     * @return string
     */
    public function getGua()
    {
        return $this->gua;
    }

    /**
     * Set sm
     *
     * @param string $sm
     *
     * @return NaoAves
     */
    public function setSm($sm)
    {
        $this->sm = $sm;

        return $this;
    }

    /**
     * Get sm
     *
     * @return string
     */
    public function getSm()
    {
        return $this->sm;
    }

    /**
     * Set sb
     *
     * @param string $sb
     *
     * @return NaoAves
     */
    public function setSb($sb)
    {
        $this->sb = $sb;

        return $this;
    }

    /**
     * Get sb
     *
     * @return string
     */
    public function getSb()
    {
        return $this->sb;
    }

    /**
     * Set spm
     *
     * @param string $spm
     *
     * @return NaoAves
     */
    public function setSpm($spm)
    {
        $this->spm = $spm;

        return $this;
    }

    /**
     * Get spm
     *
     * @return string
     */
    public function getSpm()
    {
        return $this->spm;
    }

    /**
     * Set may
     *
     * @param string $may
     *
     * @return NaoAves
     */
    public function setMay($may)
    {
        $this->may = $may;

        return $this;
    }

    /**
     * Get may
     *
     * @return string
     */
    public function getMay()
    {
        return $this->may;
    }

    /**
     * Set epa
     *
     * @param string $epa
     *
     * @return NaoAves
     */
    public function setEpa($epa)
    {
        $this->epa = $epa;

        return $this;
    }

    /**
     * Get epa
     *
     * @return string
     */
    public function getEpa()
    {
        return $this->epa;
    }

    /**
     * Set reu
     *
     * @param string $reu
     *
     * @return NaoAves
     */
    public function setReu($reu)
    {
        $this->reu = $reu;

        return $this;
    }

    /**
     * Get reu
     *
     * @return string
     */
    public function getReu()
    {
        return $this->reu;
    }

    /**
     * Set taaf
     *
     * @param string $taaf
     *
     * @return NaoAves
     */
    public function setTaaf($taaf)
    {
        $this->taaf = $taaf;

        return $this;
    }

    /**
     * Get taaf
     *
     * @return string
     */
    public function getTaaf()
    {
        return $this->taaf;
    }

    /**
     * Set nc
     *
     * @param string $nc
     *
     * @return NaoAves
     */
    public function setNc($nc)
    {
        $this->nc = $nc;

        return $this;
    }

    /**
     * Get nc
     *
     * @return string
     */
    public function getNc()
    {
        return $this->nc;
    }

    /**
     * Set wf
     *
     * @param string $wf
     *
     * @return NaoAves
     */
    public function setWf($wf)
    {
        $this->wf = $wf;

        return $this;
    }

    /**
     * Get wf
     *
     * @return string
     */
    public function getWf()
    {
        return $this->wf;
    }

    /**
     * Set pf
     *
     * @param string $pf
     *
     * @return NaoAves
     */
    public function setPf($pf)
    {
        $this->pf = $pf;

        return $this;
    }

    /**
     * Get pf
     *
     * @return string
     */
    public function getPf()
    {
        return $this->pf;
    }

    /**
     * Set cli
     *
     * @param string $cli
     *
     * @return NaoAves
     */
    public function setCli($cli)
    {
        $this->cli = $cli;

        return $this;
    }

    /**
     * Get cli
     *
     * @return string
     */
    public function getCli()
    {
        return $this->cli;
    }

    /**
     * Set aphiaId
     *
     * @param string $aphiaId
     *
     * @return NaoAves
     */
    public function setAphiaId($aphiaId)
    {
        $this->aphiaId = $aphiaId;

        return $this;
    }

    /**
     * Get aphiaId
     *
     * @return string
     */
    public function getAphiaId()
    {
        return $this->aphiaId;
    }
}
