<?php

class QaUser
{
    private $id;
    private $lastName;
    private $firstName;
    private $email;
    private $password;
    private $guests;
    private $allergy;
    private $role;

    public function __construct($id, $lastName, $firstName, $email, $password, $guests, $allergy, $role)
    {
        $this->id = $id;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
        $this->guests = $guests;
        $this->allergy = $allergy;
        $this->role = $role;
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {

        if (preg_match('/^[a-zA-Z\s]+$/', $lastName) && strlen($lastName) >= 2 && strlen($lastName) <= 20) {
            $this->lastName = $lastName;
        } else {
            throw new InvalidArgumentException("Le nom doit contenir uniquement des lettres et des espaces et doit avoir entre 2 et 20 caractères.");
        }
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {

        if (preg_match('/^[a-zA-Z\s]+$/', $firstName) && strlen($firstName) >= 2 && strlen($firstName) <= 20) {
            $this->lastName = $firstName;
        } else {
            throw new InvalidArgumentException("Le prenom doit contenir uniquement des lettres et des espaces et doit avoir entre 2 et 20 caractères.");
        }
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {

        if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
            $this->email = $email;
        } else {
            throw new InvalidArgumentException("Veuillez entrer un email valide.");
        }
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        if (strlen($password) >= 8) {
            $this->password = $password;

            return $this;
        } else {
            throw new InvalidArgumentException("Le mot de passe doit contenir au moins 8 caractères.");
        }
    }

    /**
     * Get the value of guests
     */
    public function getGuests()
    {
        return $this->guests;
    }

    /**
     * Set the value of guests
     *
     * @return  self
     */
    public function setGuests($guests)
    {
        if (is_numeric($guests) && $guests > 0) {
            $this->guests = $guests;
            return $this;
        } else {
            throw new InvalidArgumentException("Le nombre d'invités doit être un nombre.");
        }
    }

    /**
     * Get the value of allergy
     */
    public function getAllergy()
    {
        return $this->allergy;
    }

    /**
     * Set the value of allergy
     *
     * @return  self
     */
    public function setAllergy($allergy)
    {
        if (preg_match('/^[a-zA-Z\s]+$/', $allergy)) {
            $this->allergy = $allergy;
        } else {
            throw new InvalidArgumentException("Le prenom doit contenir uniquement des lettres et des espaces et doit avoir entre 2 et 20 caractères.");
        }
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}
