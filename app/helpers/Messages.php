<?php

class Messages
{

    private $data = array();

    public function sendMessageJson($arg)
    {
        if (is_object($arg)) {
            $messages = $arg->getMessages();

            foreach ($messages as $message) {
                $this->data['errors'][] = $message->getMessage();
            }
        } else {
            $this->data['success'] = $arg;
        }

        return json_encode($this->data);
    }


}