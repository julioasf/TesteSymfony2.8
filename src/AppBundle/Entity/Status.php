<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table(name="status")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatusRepository")
 */
class Status
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Atividade", mappedBy="status")
     */
    private $atividades;

    public function __construct()
    {
        $this->atividades = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Status
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add atividades
     *
     * @param \AppBundle\Entity\Atividade $atividades
     * @return Status
     */
    public function addAtividade(\AppBundle\Entity\Atividade $atividades)
    {
        $this->atividades[] = $atividades;

        return $this;
    }

    /**
     * Remove atividades
     *
     * @param \AppBundle\Entity\Atividade $atividades
     */
    public function removeAtividade(\AppBundle\Entity\Atividade $atividades)
    {
        $this->atividades->removeElement($atividades);
    }

    /**
     * Get atividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAtividades()
    {
        return $this->atividades;
    }
}
