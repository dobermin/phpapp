<?php

namespace app\Models;

class User
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var String
     */
    private string $login;
    /**
     * @var String
     */
    private string $password;
    /**
     * @var String
     */
    private string $email;
    /**
     * @var String
     */
    private string $name;

    /**
     * @param int $id
     * @param String $login
     * @param String $password
     * @param String $email
     * @param String $name
     */
    public function __construct(int $id, string $login, string $password, string $email, string $name)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @param $json
     * @return User
     */
    public static function jsonDeserialize($json): User
    {
        return new User(
            $json['id'],
            $json['login'],
            $json['password'],
            $json['email'],
            $json['name']
        );
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return
            [
                'id' => $this->getId(),
                'login' => $this->getLogin(),
                'password' => $this->getPassword(),
                'email' => $this->getEmail(),
                'name' => $this->getName()
            ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param String $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}