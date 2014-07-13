<?php
namespace PrivateMessaging\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Menuhelper extends AbstractHelper
{
    /** @noinspection PhpInconsistentReturnPointsInspection */
    public function __invoke()
    {
        if ($this->getView()->showMenu === true){
            $message = "<div class='well'>
                <h2>Menu</h2> " .
            $this->getView()->navigation('PrivateMessaging_navigation')->menu() . "</div>";

            return $message;
        }
    }
}