<?php

namespace SerNotesBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Notes
 *
 * @ORM\Table(name="notes")
 * @ORM\Entity(repositoryClass="SerNotesBundle\Repository\NotesRepository")
 */
class Notes
{
    private $note;
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
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Не пустое !")
     * @ORM\Column(name="creater_at", type="datetime", nullable=true)
     */
    private $createrAt;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Не пустое !")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="SerNotesBundle\Entity\NoteType")
     * @Assert\NotBlank()
     * inversedBy="note"
     */
    private $noteType;


    /**
     * Get id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Notes
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
     * Set content
     *
     * @param string $content
     *
     * @return Notes
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set createrAt
     *
     * @param \DateTime $createrAt
     *
     * @return Notes
     */
    public function setCreaterAt($createrAt)
    {
        $this->createrAt = $createrAt;

        return $this;
    }

    /**
     * Get createrAt
     *
     * @return \DateTime
     */
    public function getCreaterAt()
    {
        return $this->createrAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Notes
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getNoteType()
    {
        return $this->noteType;
    }

    /**
     * @param mixed $noteType
     */
    public function setNoteType(NoteType $noteType)
    {
        $this->noteType = $noteType;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }


}