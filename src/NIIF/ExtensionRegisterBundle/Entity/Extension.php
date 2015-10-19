<?php

namespace NIIF\ExtensionRegisterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(
 *     indexes={
 *         @ORM\Index(name="ix_name_id", columns={"name_id"}),
 *         @ORM\Index(name="ix_extension", columns={"extension"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="ix_name_id_u", columns={"name_id"}),
 *         @ORM\UniqueConstraint(name="ix_extension_u", columns={"extension"})
 *    }
 * )
 */
class Extension
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name_id", type="string", length=255, unique=true, nullable=false )
     */
    private $nameId;

    /**
     * @ORM\Column(name="extension", type="integer", unique=true, nullable=false )
     */
    private $extension;

    /**
     * @ORM\Column(name="last_login", type="date", nullable=false )
     */
    private $lastLogin;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameId
     *
     * @param string $nameId
     *
     * @return Extension
     */
    public function setNameId($nameId)
    {
        $this->nameId = $nameId;

        return $this;
    }

    /**
     * Get nameId
     *
     * @return string
     */
    public function getNameId()
    {
        return $this->nameId;
    }

    /**
     * Set extension
     *
     * @param integer $extension
     *
     * @return Extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return integer
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return Extension
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }
}
