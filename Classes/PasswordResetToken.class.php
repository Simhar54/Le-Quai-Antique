<?php

class PasswordResetToken
{
    private $id;
    private $user_id;
    private $token;
    private $expiration_date;
    private $used;

    public function __construct($id = null, $user_id = null, $token = null, $expiration_date = null, $used = null)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->token = $token;
        $this->expiration_date = $expiration_date;
        $this->used = $used;
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
        if (is_int($id)) {
            $this->id = $id;
        } else {
            throw new InvalidArgumentException('L\id doit être un entier');
        }

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

      /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        if (is_int($user_id)) {
            $this->user_id = $user_id;
        } else {
            throw new InvalidArgumentException('User_id doit etre un entier.');
        }

        return $this;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */ 
    public function setToken($token)
    {
        if (is_int($token) && strlen((string) $token) === 4) {
            $this->token = $token;
        } else {
            throw new InvalidArgumentException('Token doit etre un entier.');
        }

        return $this;
    }
    /**
     * Get the value of expiration_date
     */ 
    public function getExpiration_date()
    {
        return $this->expiration_date;
    }

     /**
     * Set the value of expiration_date
     *
     * @return  self
     */ 
    public function setExpiration_date($expiration_date)
    {
        if (strtotime($expiration_date) !== false) {
            $this->expiration_date = $expiration_date;
        } else {
            throw new InvalidArgumentException('La date d\expiration doit etre une date valide.');
        }

        return $this;
    }
    /**
     * Get the value of used
     */ 
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * Set the value of used
     *
     * @return  self
     */ 
    public function setUsed($used)
    {
        if ($used === 0 || $used === 1) {
            $this->used = $used;
        } else {
            throw new InvalidArgumentException('Used doit etre un entier.');
        }

        return $this;
    }
}

    