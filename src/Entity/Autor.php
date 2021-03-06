<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *
 * @ORM\Entity(repositoryClass=App\Repository\AutorRepository::class)
 * @UniqueEntity(
 * fields={"email"}, 
 * message =" Desole un autre utilisateur possede cet email"
 * )
 */
class Autor implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez renseigner votre nom ou prenom !")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="vous n'avez pas entrez un email valide !")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="votre mot de passe doit avoir minimun 8 caracteres !")
     * 
     */
    private $passeword;

    /**
     * @Assert\EqualTo(propertyPath="passeword", message="vous n'avez pas saisi le meme mot de passse ! ")
     */
    public $confirm_passeword;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, mappedBy="user")
     */
    private $userRole;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="autors", orphanRemoval=true)
     */
    private $comments;

    public function __construct()
    {
        $this->userRole = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


    public function __toString()
    {
        return '' . $this->name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPasseword(): ?string
    {
        return $this->passeword;
    }

    public function setPasseword(string $passeword): self
    {
        $this->passeword = $passeword;

        return $this;
    }

    
    //les functions de user interface
    public function getRoles()
    {
      $role = $this->userRole->map(function($role){
          return $role->getTitle();
      })->toArray();
       $role[] = 'ROLE_USER';
       return $role;
    }

    public function getPassword()
    {
        return $this->passeword;
    }
    public function getSalt()
    {
    }
    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRole(): Collection
    {
        return $this->userRole;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRole->contains($userRole)) {
            $this->userRole[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRole->removeElement($userRole)) {
            $userRole->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAutors($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAutors() === $this) {
                $comment->setAutors(null);
            }
        }

        return $this;
    }
}
