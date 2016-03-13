<?php

namespace PrivateMessaging\Mapper;

use Zend\Db\Sql\Expression as SqlExpression;
use ZfcUser\Entity\UserInterface;
use Zend\Db\Sql\Select;
use Zend\Filter\Word\UnderscoreToCamelCase;

class UserMapper extends \ZfcUser\Mapper\User
{
    /**
     * @var UserInterface           Currently logged in user
     */
    protected $currentUser;
    /**
     * @var string                  The columns needed to disply.
     */
    protected $userColumn;


    /**
     * sets Currently logged in user
     *
     * @param UserInterface $currentUser
     * @return void
     */
    public function setCurrentUser(UserInterface $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    /**
     * gets Currently logged in user
     *
     * @return UserInterface $currentUser
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    /**
     * @return the $userColumn
     */
    public function getUserColumn()
    {
        return $this->userColumn;
    }

    /**
     * @param string $userColumn
     */
    public function setUserColumn($userColumn)
    {
        $this->userColumn = $userColumn;
    }

    /**
     * gets users list
     *
     * @param array                                     $columns columns to fetch from user table
     * @param callable|\PrivateMessaging\Mapper\Closure $Closure $Closure       to manipulate Select
     *
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($columns = null, \Closure $Closure = null)
    {
        $select = $this->getSelect();
        if ($columns) {
            $select->columns($columns);
        }
        if ($Closure) {
            $Closure($select);
        }
        return $this->select($select);
    }

    /**
     * gets users list for Select form element
     *
     * @return array
     */
    public function getSelectOptions()
    {
        $filter = new UnderscoreToCamelCase();
        $funcName = "get" . ucfirst($filter->filter($this->getUserColumn()));

        $resultSet =  $this->fetchAll(array('user_id', $this->getUserColumn()), function (Select $select) {
            $select->where->notEqualTo('user_id', $this->getCurrentUser()->getId());
        });

        $options = array();
        foreach ($resultSet as $user) {
            $options[$user->getId()] = $user->$funcName();
        }

        return $options;
    }
}
