<?php

namespace PrivateMessaging\Mapper;

use ZfcBase\Mapper\AbstractDbMapper;
use ZfcUser\Entity\UserInterface;
use Zend\Db\Sql\Expression as SqlExpression;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Stdlib\Hydrator\HydratorInterface;

class MessageMapper extends AbstractDbMapper implements MessageMapperInteface
{
    protected $tableName = "message";

    public function findById($messageId)
    {
        $select = $this->getSelect();
        $select->where(array('id' => $messageId));
        return $this->select($select)->current();
    }

    public function findBySenderId($senderId, $paginated = false)
    {
        $select = $this->getSelect();
        $select->where(array('sender_id' => $senderId));

        if ($paginated) {
            return new Paginator(new DbSelect($select, $this->getDbAdapter()));
        }

        return $this->select($select);
    }

    public function findBySender(UserInterface $sender)
    {
        return $this->findBySenderId($sender->getId());
    }

    public function insert($message, $tablename = null, HydratorInterface $hydrator = null)
    {
        $message->setCreatedDateTime(new \DateTime());
        $result = parent::insert($message, $tablename, $hydrator);
        $message->setId($result->getGeneratedValue());
        return $result;
    }

    public function update($message, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = array('id' => $message->getId());
        }

        return parent::update($message, $where, $tableName, $hydrator);
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }
}
