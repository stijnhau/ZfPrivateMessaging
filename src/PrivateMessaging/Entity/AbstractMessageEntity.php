<?php
    
namespace PrivateMessaging\Entity;

abstract class AbstractMessageEntity
{
    const STARRED = 1;

    const NOT_STARRED = 0;

    const IMPORTANT = 1;

    const NOT_IMPORTANT = 0;

    /**
     * @var int id
     */
    protected $id;

    /**
     * @var int $starredOrNot
     */
    protected $starredOrNot = self::NOT_STARRED;

    /**
     * @var int $importantOrNot
     */
    protected $importantOrNot = self::NOT_IMPORTANT;

    /**
     * Sets id
     *
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
     * gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set if message a starred or not
     *
     * @param int $starredOrNot
     * @return self
     */
    public function setStarredOrNot($starredOrNot)
    {
        $this->starredOrNot = (int) $starredOrNot;
        return $this;
    }

    /**
     * sets a message as starred
     *
     * @return self
     */
    public function setStarred()
    {
        $this->setStarredOrNot(static::STARRED);
        return $this;
    }

    /**
     * sets a message as not starred
     *
     * @return self
     */
    public function setUnstarred()
    {
        $this->setStarredOrNot(static::NOT_STARRED);
        return $this;
    }

    /**
     * checks if a message is starred
     *
     * @return int      1 if starred else 0
     */
    public function getStarredOrNot()
    {
        return $this->starredOrNot;
    }

    /**
     * checks if a message is starred
     *
     * @return bool
     */
    public function isStarred()
    {
        return $this->getStarredOrNot() === static::STARRED;
    }

    /**
     * sets a message as important or not important
     *
     * @param int $importantOrNot
     * @return self
     */
    public function setImportantOrNot($importantOrNot)
    {
        $this->importantOrNot = (int) $importantOrNot;
        return $this;
    }

    /**
     * sets a message as important
     *
     * @return self
     */
    public function setImportant()
    {
        $this->setImportantOrNot(static::IMPORTANT);
        return $this;
    }

    /**
     * sets a message as not important
     *
     * @return self
     */
    public function setUnimportant()
    {
        $this->setImportantOrNot(static::NOT_IMPORTANT);
        return $this;
    }

    /**
     * checks if a message is marked as important or not
     *
     * @return int
     */
    public function getImportantOrNot()
    {
        return $this->importantOrNot;
    }

    /**
     * checks if a message is marked as important or not
     *
     * @return bool
     */
    public function isImportant()
    {
        return $this->getImportantOrNot() === static::IMPORTANT;
    }
}
