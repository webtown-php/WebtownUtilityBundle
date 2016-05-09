<?php

namespace Webtown\UtilityBundle\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation\Timestampable;

trait TimestampableTrait
{
    /**
     * Létrehozás időpontja
     *
     * @var \DateTime $createdAt
     *
     * @Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false, options={
     *          "comment": "Létrehozás időpontja"})
     */
    protected $createdAt;

    /**
     * Utolsó módosítás időpontja
     *
     * @var \DateTime $updatedAt
     *
     * @Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false, options={
     *          "comment": "Utolsó módosítás időpontja"})
     */
    protected $updatedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     *
     * @internal
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     *
     * @internal
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
