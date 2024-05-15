<?php
class User
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phone = null;
    private ?int $role = null;

    private ?string $password = null;

    public function __construct($id, $name, $email, $phone, $role, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPassword() {
        return $this->password;
    }
}
