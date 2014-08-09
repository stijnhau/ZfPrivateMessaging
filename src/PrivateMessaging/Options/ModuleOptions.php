<?php

namespace PrivateMessaging\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements
    EntityOptionsInterface,
    MultipleReceiversOptionsInterface
{
    protected $sendEmailMessage = false;
    protected $enableMultipleReceivers = true;
    protected $messageEntityClass = "PrivateMessaging\Entity\Message";
    protected $messageReceiverEntityClass = "PrivateMessaging\Entity\MessageReceiver";
    protected $loginRoute = "zfcuser/login";
    protected $allowDeleteMessage = true;
    protected $showMenu = true;
    protected $enableDeletelinkMessage = true;
    protected $enableReplylinkMessage = true;
    protected $userColumn = "email";
    protected $msgPerPage = 20;
    protected $showTimeAgo = false;
    protected $sortDirection= "DESC";

	/**
     * @return the $sortDirection
     */
    public function getSortDirection()
    {
        return $this->sortDirection;
    }

	/**
     * @param string $sortDirection
     */
    public function setSortDirection($sortDirection)
    {
        $this->sortDirection = $sortDirection;
    }

	/**
     * @return the $showTimeAgo
     */
    public function getShowTimeAgo()
    {
        return $this->showTimeAgo;
    }

	/**
     * @param boolean $showTimeAgo
     */
    public function setShowTimeAgo($showTimeAgo)
    {
        $this->showTimeAgo = $showTimeAgo;
    }

	/**
     * @return the $msgPerPage
     */
    public function getMsgPerPage()
    {
        return $this->msgPerPage;
    }

	/**
     * @param number $msgPerPage
     */
    public function setMsgPerPage($msgPerPage)
    {
        $this->msgPerPage = $msgPerPage;
    }

	/**
     * @return the $sendEmailMessage
     */
    public function getSendEmailMessage()
    {
        return $this->sendEmailMessage;
    }

	/**
     * @return the $enableMultipleReceivers
     */
    public function getEnableMultipleReceivers()
    {
        return $this->enableMultipleReceivers;
    }

	/**
     * @return the $messageEntityClass
     */
    public function getMessageEntityClass()
    {
        return $this->messageEntityClass;
    }

	/**
     * @return the $messageReceiverEntityClass
     */
    public function getMessageReceiverEntityClass()
    {
        return $this->messageReceiverEntityClass;
    }

	/**
     * @return the $loginRoute
     */
    public function getLoginRoute()
    {
        return $this->loginRoute;
    }

	/**
     * @return the $allowDeleteMessage
     */
    public function getAllowDeleteMessage()
    {
        return $this->allowDeleteMessage;
    }

	/**
     * @return the $showMenu
     */
    public function getShowMenu()
    {
        return $this->showMenu;
    }

	/**
     * @return the $enableDeletelinkMessage
     */
    public function getEnableDeletelinkMessage()
    {
        return $this->enableDeletelinkMessage;
    }

	/**
     * @return the $enableReplylinkMessage
     */
    public function getEnableReplylinkMessage()
    {
        return $this->enableReplylinkMessage;
    }

	/**
     * @param boolean $sendEmailMessage
     */
    public function setSendEmailMessage($sendEmailMessage)
    {
        $this->sendEmailMessage = $sendEmailMessage;
    }

	/**
     * @param boolean $enableMultipleReceivers
     */
    public function setEnableMultipleReceivers($enableMultipleReceivers)
    {
        $this->enableMultipleReceivers = $enableMultipleReceivers;
    }

	/**
     * @param string $messageEntityClass
     */
    public function setMessageEntityClass($messageEntityClass)
    {
        $this->messageEntityClass = $messageEntityClass;
    }

	/**
     * @param string $messageReceiverEntityClass
     */
    public function setMessageReceiverEntityClass($messageReceiverEntityClass)
    {
        $this->messageReceiverEntityClass = $messageReceiverEntityClass;
    }

	/**
     * @param string $loginRoute
     */
    public function setLoginRoute($loginRoute)
    {
        $this->loginRoute = $loginRoute;
    }

	/**
     * @param boolean $allowDeleteMessage
     */
    public function setAllowDeleteMessage($allowDeleteMessage)
    {
        $this->allowDeleteMessage = $allowDeleteMessage;
    }

	/**
     * @param boolean $showMenu
     */
    public function setShowMenu($showMenu)
    {
        $this->showMenu = $showMenu;
    }

	/**
     * @param boolean $enableDeletelinkMessage
     */
    public function setEnableDeletelinkMessage($enableDeletelinkMessage)
    {
        $this->enableDeletelinkMessage = $enableDeletelinkMessage;
    }

	/**
     * @param boolean $enableReplylinkMessage
     */
    public function setEnableReplylinkMessage($enableReplylinkMessage)
    {
        $this->enableReplylinkMessage = $enableReplylinkMessage;
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
}
