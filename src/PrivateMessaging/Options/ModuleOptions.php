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

	/**
     * @return the $sendEmailMessage
     */
    public function getSendEmailMessage()
    {
        return $this->sendEmailMessage;
    }

	/**
     * @param boolean $sendEmailMessage
     */
    public function setSendEmailMessage($sendEmailMessage)
    {
        $this->sendEmailMessage = $sendEmailMessage;
    }

	/**
     * @return the $enableMultipleReceivers
     */
    public function getEnableMultipleReceivers()
    {
        return $this->enableMultipleReceivers;
    }

	/**
     * @param boolean $enableMultipleReceivers
     */
    public function setEnableMultipleReceivers($enableMultipleReceivers)
    {
        $this->enableMultipleReceivers = $enableMultipleReceivers;
    }

	/**
     * @return the $messageEntityClass
     */
    public function getMessageEntityClass()
    {
        return $this->messageEntityClass;
    }

	/**
     * @param string $messageEntityClass
     */
    public function setMessageEntityClass($messageEntityClass)
    {
        $this->messageEntityClass = $messageEntityClass;
    }

	/**
     * @return the $messageReceiverEntityClass
     */
    public function getMessageReceiverEntityClass()
    {
        return $this->messageReceiverEntityClass;
    }

	/**
     * @param string $messageReceiverEntityClass
     */
    public function setMessageReceiverEntityClass($messageReceiverEntityClass)
    {
        $this->messageReceiverEntityClass = $messageReceiverEntityClass;
    }

	/**
     * @return the $loginRoute
     */
    public function getLoginRoute()
    {
        return $this->loginRoute;
    }

	/**
     * @param string $loginRoute
     */
    public function setLoginRoute($loginRoute)
    {
        $this->loginRoute = $loginRoute;
    }

	/**
     * @return the $allowDeleteMessage
     */
    public function getAllowDeleteMessage()
    {
        return $this->allowDeleteMessage;
    }

	/**
     * @param boolean $allowDeleteMessage
     */
    public function setAllowDeleteMessage($allowDeleteMessage)
    {
        $this->allowDeleteMessage = $allowDeleteMessage;
    }

	/**
     * @return the $showMenu
     */
    public function getShowMenu()
    {
        return $this->showMenu;
    }

	/**
     * @param boolean $showMenu
     */
    public function setShowMenu($showMenu)
    {
        $this->showMenu = $showMenu;
    }
}
