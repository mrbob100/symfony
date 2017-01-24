<?php

namespace VL\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface
{
    public $file;
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $expired_at;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $ip_address;

    /**
     * @var string
     */
    private $numContract;

    /**
     * @var string
     */
    private $strokaContract;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $lessons;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lessons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }




    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set first_name
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set last_name
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = new \DateTime();

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set expired_at
     *
     * @param \DateTime $expiredAt
     * @return User
     */
    public function setExpiredAt($expiredAt)
    {
        $this->expired_at = $expiredAt;

        return $this;
    }

    /**
     * Get expired_at
     *
     * @return \DateTime 
     */
    public function getExpiredAt()
    {
        return $this->expired_at;
    }

   

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set ip_address
     *
     * @param string $ipAddress
     * @return User
     */
    public function setIpAddress($ipAddress)
    {
        $this->ip_address = $ipAddress;

        return $this;
    }

    /**
     * Get ip_address
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ip_address;
    }

    /**
     * Set numContract
     *
     * @param string $numContract
     * @return User
     */
    public function setNumContract($numContract)
    {
        $this->numContract = $numContract;

        return $this;
    }

    /**
     * Get numContract
     *
     * @return string 
     */
    public function getNumContract()
    {
        return $this->numContract;
    }

    /**
     * Add lessons
     *
     * @param \VL\SiteBundle\Entity\Lesson $lessons
     * @return User
     */
    public function addLesson(\VL\SiteBundle\Entity\Lesson $lessons)
    {
        $this->lessons[] = $lessons;

        return $this;
    }

    /**
     * Remove lessons
     *
     * @param \VL\SiteBundle\Entity\Lesson $lessons
     */
    public function removeLesson(\VL\SiteBundle\Entity\Lesson $lessons)
    {
        $this->lessons->removeElement($lessons);
    }

    /**
     * Get lessons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLessons()
    {
        return $this->lessons;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiredAtValue()
    {
        if(!$this->getExpiredAt()) {
            $now = $this->getCreatedAt() ? $this->getCreatedAt()->format('U') : time();
            $this->expired_at = new \DateTime(date('Y-m-d H:i:s', $now + 86400 * 100));
        }
    }

    public function __toString()
    {
        return $this->getEmail() ? $this->getEmail() : "";
    }



    /**
     * Set strokaContract
     *
     * @param string $strokaContract
     * @return User
     */
    public function setStrokaContract($strokaContract)
    {
        $this->strokaContract = $strokaContract;

        return $this;
    }

    /**
     * Get strokaContract
     *
     * @return string 
     */
    public function getStrokaContract()
    {
        return $this->strokaContract;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function getRoles()
    {
       // return array('IS_AUTHENTICATED_ANONYMOUSLY');
         return array('ROLE_ADMIN');
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials()
    {

    }

    public function equals(User $user)
    {
        return $user->getUsername() == $this->getUsername();
    }



    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }
}
