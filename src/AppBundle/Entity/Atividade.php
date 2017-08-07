<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Atividade
 *
 * @ORM\Table(name="atividade")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AtividadeRepository")
 */
class Atividade
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
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="situacao", type="string", length=20)
     */
    private $situacao;

    /**
     * @ORM\ManyToOne(targetEntity="Status", inversedBy="atividades")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     *
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 600,
     *      maxMessage = "Maximo de 600 caracteres."
     * )
     */
    private $descricao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="date")
     *
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_fim", type="date", nullable=true)
     *
     * @Assert\Date()
     */
    private $dataFim;

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
     * @return Atividade
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
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     * @return Atividade
     */
    public function setStatus(\AppBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Atividade
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return Atividade
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime 
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataFim
     *
     * @param \DateTime $dataFim
     * @return Atividade
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    /**
     * Get dataFim
     *
     * @return \DateTime 
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * Set situacao
     *
     * @param string $situacao
     * @return Atividade
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Get situacao
     *
     * @return string 
     */
    public function getSituacao()
    {
        return $this->situacao;
    }
}
