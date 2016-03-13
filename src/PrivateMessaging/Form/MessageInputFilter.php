<?php

namespace PrivateMessaging\Form;

use ZfcBase\InputFilter\ProvidesEventsInputFilter;
use Zend\Filter\Int;
use PrivateMessaging\Options\MultipleReceiversOptionsInterface;
use Zend\Validator\NotEmpty;

class MessageInputFilter extends ProvidesEventsInputFilter
{

    protected $options;

    public function __construct(MultipleReceiversOptionsInterface $options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function init()
    {
        $this->add(array(
            'name' => 'subject',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            NotEmpty::IS_EMPTY => 'Please enter message subject'
                        )
                    )
                ),
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'max' => 64
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'receiver_id',
            'required' => false
        ));

        $this->add(array(
            'name' => 'message_text',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            NotEmpty::IS_EMPTY => 'Please enter a body of message '
                        )
                    )
                )
            )
        ));

        if ($this->getOptions()->getEnableMultipleReceivers()) {
            $this->add(array(
                'name' => 'receiver_id',
                'filters' => array(
                    array(
                        'name' => 'Callback',
                        'options' => array(
                            'callback' => function ($values) {
                                $output = array();
                                $filter = new Int();
                                foreach ($values as $value) {
                                    $output[] = $filter->filter($value);
                                }
                                return $output;
                            }
                        )
                    )
                )
            ));
        } else {
            $this->add(array(
                'name' => 'receiver_id',
                'filters' => array(
                    array(
                        'name' => 'Int',
                    )
                )
            ));
        }
    }
}
