<?php

namespace App\Entity;

use App\Repository\UpdatepasswordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


class Updatepassword
{
    private $passeword;

    /**
     *
     * @Assert\Length(min="8", minMessage="votre mot de passe doit avoir minimun 8 caracteres !")
     */
    private $newPassword;

    /**
     *
     *
     * @Assert\EqualTo(propertyPath="newPassword", message="vous n'avez pas saisi le meme mot de passse ! ")
     */
    private $confirPassword;


    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setnewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

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

    public function getConfirPassword(): ?string
    {
        return $this->confirPassword;
    }

    public function setConfirPassword(string $confirPassword): self
    {
        $this->confirPassword = $confirPassword;

        return $this;
    }
}
