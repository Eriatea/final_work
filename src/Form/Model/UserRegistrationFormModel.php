<?php

namespace App\Form\Model;

use App\Validator\UniqueUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationFormModel
{
    /**
     * @Assert\NotBlank(message="Вы не указали email")
     * @Assert\Email()
     * @UniqueUser()
     */
    public string $email;

    /**
     * @Assert\NotBlank(message="Вы не указали имя")
     * @Assert\Length(max=50, maxMessage="Имя не должно быть длиннее 50 символов")
     * @UniqueUser()
     */
    public string $firstName;

    /**
     * @Assert\NotBlank(message="Пароль не указан")
     * @Assert\Length(min=6,minMessage="Пароль должен быть длиной не менее 6-ти символов")
     */
    public string $plainPassword;

    /**
     * @Assert\IsTrue(message="Вы должны согласиться с условиями")
     */
    public bool $agreeTerms;

    /**
     * @return bool
     */
    public function getAgreeTerms(): bool
    {
        return filter_var($this->agreeTerms, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email): void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            $this->email = $email;
        } else {
            throw new \InvalidArgumentException("Введите корректный email");
        }
    }
}