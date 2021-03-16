<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;

/**
 * @ORM\Entity(repositoryClass=App\Repository\CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAd;

    /**
     * @ORM\ManyToOne(targetEntity=Award::class, inversedBy="comments", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $awards;

    /**
     * @ORM\ManyToOne(targetEntity=Autor::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autors;

   
    public function __construct()
    {
        $this->createAd = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreateAd(): ?\DateTimeInterface
    {
        return $this->createAd;
    }

    public function setCreateAd(\DateTimeInterface $createAd): self
    {
        $this->createAd = $createAd;

        return $this;
    }

    public function getAwards(): ?Award
    {
        return $this->awards;
    }

    public function setAwards(?Award $awards): self
    {
        $this->awards = $awards;

        return $this;
    }

    public function getAutors(): ?Autor
    {
        return $this->autors;
    }

    public function setAutors(?Autor $autors): self
    {
        $this->autors = $autors;

        return $this;
    }

}
