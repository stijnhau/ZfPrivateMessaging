<?php

namespace PrivateMessaging\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SmartTime extends AbstractHelper
{
    public function fromTimeStamp($timestamp)
    {
        $diff = time() - $timestamp;
        if ($diff <= 0) {
            return 'Just Now';
        } elseif ($diff < 60) {
            return $this->grammarDate(floor($diff), ' second(s) ago');
        } elseif ($diff < 60 * 60) {
            return $this->grammarDate(floor($diff / 60), ' minute(s) ago');
        } elseif ($diff < 60 * 60 * 24) {
            return $this->grammarDate(floor($diff / (60 * 60)), ' hour(s) ago');
        } elseif ($diff < 60 * 60 * 24 * 30) {
            return $this->grammarDate(floor($diff / (60 * 60 * 24)), ' day(s) ago');
        } elseif ($diff < 60 * 60 * 24 * 30 * 12) {
            return $this->grammarDate(floor($diff / (60 * 60 * 24 * 30)), ' month(s) ago');
        } else {
            return $this->grammarDate(floor($diff / (60 * 60 * 24 * 30 * 12)), ' year(s) ago');
        }
    }

    public function fromDateTime($dateTime)
    {
        if ($this->getView()->showTimeAgo === true) {
            $dateTimeObject = new \DateTime($dateTime);
            return $this->fromTimeStamp($dateTimeObject->getTimestamp());
        } else {
            return $dateTime;
        }
    }

    protected function grammarDate($val, $sentence)
    {
        if ($val > 1) {
            return $val . str_replace('(s)', 's', $sentence);
        } else {
            return $val . str_replace('(s)', '', $sentence);
        }
    }
}
