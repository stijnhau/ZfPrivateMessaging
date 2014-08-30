<?php

namespace PrivateMessaging\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Filter\Word\UnderscoreToCamelCase;
use PrivateMessaging\Entity\MessageReceiver;

class MessagingController extends AbstractActionController
{

    const ROUTE_MESSAGING = "privatemessaging";

    /**
     * @var PrivateMessaging\Mapper\MessageMapper
     */
    protected $messageMapper;

    /**
     * @var PrivateMessaging\Mapper\MessageReceiverMapper
     */
    protected $messageReceiverMapper;

    /**
     * @var PrivateMessaging\Options\ModuleOptions
     */
    protected $moduleOptions;

    /**
     *@var PrivateMessaging\Service\MessagingService
     */
    protected $messagingService;

    /**
     * @var PrivateMessaging\Mapper\UserMapper
     */
    protected $userMapper;


    public function composeAction()
    {
        $form = $this->getServiceLocator()->get('PrivateMessaging\MessageForm');

        $messageSent = false;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData = $request->getPost()->toArray();
            if ($this->getMessagingService()->createMessage($postData)) {
                $messageSent = true;
            }
        }

        return array(
            'form' => $form,
            'messageSent' => $messageSent,
            'showMenu'  => $this->getModuleOptions()->getShowMenu(),
        );
    }

    public function listAction()
    {
        $user = $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity();

        $type = $this->params()->fromRoute('type', 'inbox');

        $viewModel = new ViewModel(
            array(
                'type'      => $type,
                'showMenu'  => $this->getModuleOptions()->getShowMenu(),
                'showTimeAgo'  => $this->getModuleOptions()->getShowTimeAgo(),
            )
        );

        switch ($type)
        {
            case 'inbox':
                $messages = $this->getMessageReceiverMapper()->findByReceiverId($user->getId(), true);
                break;
            case "starred":
                $messages = $this->getMessageReceiverMapper()->findStarredMessagesByReceiverId($user->getId(), true);
                break;
            case "important":
                $messages = $this->getMessageReceiverMapper()->findImportantMessagesByReceiverId($user->getId(), true);
                break;
            case "unread":
                $messages = $this->getMessageReceiverMapper()->findUnreadMessagesByReceiverId($user->getId(), true);
                break;
            case "sent":
                $messages = $this->getMessageMapper()->findBySenderId($user->getId(), true);
                break;
            default:
                return $this->notFoundAction();
        }

        $messages->setItemCountPerPage($this->getModuleOptions()->getMsgPerPage());
        $messages->setCurrentPageNumber($this->params()->fromRoute('page', 1));
        $viewModel->setVariable('messagesOrig', $messages);

        $filter = new UnderscoreToCamelCase();
        $funcName = "get" . ucfirst($filter->filter($this->getModuleOptions()->getUserColumn()));

        $messages2 = array();
        foreach ($messages as $message) {
            $sender = $this->getUserMapper()->findById($message->sender_id);

            if (!isset($message['message_id'])) {
                $message['message_id'] = $message['id'];
            }
            $message["sender"] = $sender->$funcName();
            $messages2[] = $message;
        }

        $viewModel->setVariable('messages', $messages2);

        return $viewModel;
    }

    /**
     * this methods show message body of a received message
     */
    public function infoAction()
    {
        // Check if we have a message id in the route
        $message_id = $this->params()->fromRoute('message_id', null);
        if (!$message_id) {
            return $this->notFoundAction();
        }

        // Get the mapper of the message
        $message = $this->getMessageMapper()->findById($message_id);
        if (!$message) {
            return $this->notFoundAction();
        }

        // Get the options and the gettername for retrieving receiver and senderInfo
        $options = $this->getModuleOptions();
        $filter = new UnderscoreToCamelCase();
        $filterName = $filter->filter($options->getUserColumn());
        $funcName = "get" . ucfirst($filterName);

        $user = $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity();

        $messageReceiver = $this->getMessageReceiverMapper()->findByReceiverIdAndMessageId($message_id, $user->getId());

        if ($messageReceiver instanceof MessageReceiver && !$messageReceiver->isReceived()) {
            $messageReceiver->setReceived();
            $this->getMessageReceiverMapper()->update($messageReceiver);
        }

        $sender = $this->getServiceLocator()->get('privatemessaging_user_mapper')->findById($message->getSenderId())->$funcName();

        $messageReceivers = $this->getMessageReceiverMapper()->findByMessage($message);

        if (count($messageReceivers) === 1) {
            $receiver = $this->getUserMapper()->findById($messageReceivers->current()->getReceiverId())->$funcName();
        } else {
            $messageReceivers = iterator_to_array($messageReceivers);

            $receivers = $this->getMessagingService()->getReceivers($message, $messageReceivers);

            $receiver = "";
            foreach ($receivers as $receiverLoop) {
                $receiver .= $receiverLoop->$funcName() . ", ";
            }
        }
        return new ViewModel(
            array(
                'message' => $message,
                'messageReceiver' => $messageReceiver,
                'sender' => $sender,
                'showMenu'  => $options->getShowMenu(),
                'receiverCount' => count($messageReceivers),
                'receiver' => $receiver,
                'showTimeAgo'  => $this->getModuleOptions()->getShowTimeAgo(),
            )
        );
    }

    public function deleteReceiverAction()
    {
        if (!$this->getModuleOptions()->getAllowDeleteMessage()) {
            return $this->notFoundAction();
        }

        $id = $this->params()->fromRoute('message_id', null);
        if (!$id) {
            return $this->notFoundAction();
        }

        $messageReceiver = $this->getMessageReceiverMapper()->findById($id);
        if (!$messageReceiver) {
            return $this->notFoundAction();
        }
        
        if ($messageReceiver->getreceiverId() != $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity()->getId()) {
            /**
             * @todo create a vieuw for this issue.
             */
            die();
        }
        
        $this->getMessageReceiverMapper()->deleteById($id);

        return $this->redirect()->toRoute(static::ROUTE_MESSAGING);
    }

    public function deleteSenderAction()
    {
        echo "Stap1";
        return $this->notFoundAction();
    }

    /*
    public function messageEditAction()
    {
        $type = $this->params()->fromRoute('type', null);
        $id = $this->params()->fromRoute('id', null);
        if (!$type || $id) {
            return $this->notFoundAction();
        }

        $message = $this->getMessageMapper()->findById($id);
        if (!$message) {
            return $this->notFoundAction();
        }

        switch(strtolower($type))
        {
            case "star":
                if ($message->isStarred()) {
                    $message->setStarred();
                } else {
                    $message->setUnstarred();
                }
                break;
            case "important":
                if ($message->isImportant()) {
                    $message->setImportant();
                } else {
                    $message->setUnimportant();
                }
                break;
            default:
                return $this->notFoundAction();
        }
        $this->getMessageMapper()->update($message);

        return new JsonModel(array(
            'changed' => true
        ));
    }
    */
    
    /*
    public function messageReceiverEditAction()
    {
        $type = $this->params()->fromRoute('type', null);
        $id = $this->params()->fromRoute('id', null);
        if (!$type || $id) {
            return $this->notFoundAction();
        }

        $messageReceiver = $this->getMessageReceiverMapper()->findById($id);
        if (!$messageReceiver) {
            return $this->notFoundAction();
        }

        switch(strtolower($type))
        {
            case "star":
                if ($messageReceiver->isStarred()) {
                    $messageReceiver->setStarred();
                } else {
                    $messageReceiver->setUnstarred();
                }

                break;
            case "important":
                if ($messageReceiver->isImportant()) {
                    $messageReceiver->setImportant();
                } else {
                    $messageReceiver->setUnimportant();
                }
                break;
            default:
                return $this->notFoundAction();
        }
        $this->getMessageReceiverMapper()->update($messageReceiver);

        return new JsonModel(array(
            'changed' => true
        ));
    }
    */

    /**
     * gets MessageMapper
     *
     * @return \PrivateMessaging\Options\ModuleOptions
     */
    protected function getMessageMapper()
    {
        if (!$this->messageMapper) {
            $this->messageMapper = $this->getServiceLocator()->get('PrivateMessaging\MessageMapper');
        }

        return $this->messageMapper;
    }

    protected function getMessageReceiverMapper()
    {
        if (!$this->messageReceiverMapper) {
            $this->messageReceiverMapper = $this->getServiceLocator()->get('PrivateMessaging\MessageReceiverMapper');
        }

        return $this->messageReceiverMapper;
    }

    /**
     * gets module options from ServiceManager
     *
     * @return \PrivateMessaging\Options\ModuleOptions
     */
    protected function getModuleOptions()
    {
        if (!$this->moduleOptions) {
            $this->moduleOptions = $this->getServiceLocator()->get('PrivateMessaging\ModuleOptions');
        }

        return $this->moduleOptions;
    }


    /**
     * gets Messaging Service
     *
     * @return PrivateMessaging\Service\MessagingService
     */
    protected function getMessagingService()
    {
        if (!$this->messagingService) {
            $this->messagingService = $this->getServiceLocator()->get('PrivateMessaging\Service\MessagingService');
        }

        return $this->messagingService;
    }

    /**
     * gets User Mapper
     *
     * @return PrivateMessaging\Mapper\UserMapper
     */
    protected function getUserMapper()
    {
        if (!$this->userMapper) {
            $this->userMapper = $this->getServiceLocator()->get('zfcuser_user_mapper');
        }

        return $this->userMapper;
    }
}
