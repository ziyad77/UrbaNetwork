<?php

namespace Urbanet\CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* Competition
*
* @ORM\Table()
* @ORM\Entity(repositoryClass="Urbanet\CvBundle\Entity\CompetitionRepository")
*/
class Competition
{
    /**
* @var integer
*
* @ORM\Column(name="id", type="integer")
* @ORM\Id
* @ORM\GeneratedValue(strategy="AUTO")
*/
    private $id;

    /**
* @var string
*
* @ORM\Column(name="Type", type="string", length=255)
*/
    private $Type;

    /**
* @var string
*
* @ORM\Column(name="Libelle", type="string", length=255)
*/
    private $Libelle;

    /**
* @var \DateTime
*
* @ORM\Column(name="Date", type="date")
*/
    private $Date;

    /**
* @var string
*
* @ORM\Column(name="Lieu", type="string", length=255)
*/
    private $Lieu;



    /**
* Get id
*
* @return integer
*/
    public function getId()
    {
        return $this->id;
    }

    /**
* Set Type
*
* @param string $type
* @return Competition
*/
    public function setType($type)
    {
        $this->Type = $type;
    
        return $this;
    }

    /**
* Get Type
*
* @return string
*/
    public function getType()
    {
        return $this->Type;
    }

    /**
* Set Libelle
*
* @param string $libelle
* @return Competition
*/
    public function setLibelle($libelle)
    {
        $this->Libelle = $libelle;
    
        return $this;
    }

    /**
* Get Libelle
*
* @return string
*/
    public function getLibelle()
    {
        return $this->Libelle;
    }

    /**
* Set Date
*
* @param \DateTime $date
* @return Competition
*/
    public function setDate($date)
    {
        $this->Date = $date;
    
        return $this;
    }

    /**
* Get Date
*
* @return \DateTime
*/
    public function getDate()
    {
        return $this->Date;
    }

    /**
* Set Lieu
*
* @param string $lieu
* @return Competition
*/
    public function setLieu($lieu)
    {
        $this->Lieu = $lieu;
    
        return $this;
    }

    /**
* Get Lieu
*
* @return string
*/
    public function getLieu()
    {
        return $this->Lieu;
    }

    /**
* Set Classement
*
* @param integer $classement
* @return Competition
*/
    public function setClassement($classement)
    {
        $this->Classement = $classement;
    
        return $this;
    }

    /**
* Get Classement
*
* @return integer
*/
    public function getClassement()
    {
        return $this->Classement;
    }
}