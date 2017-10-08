<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected $messages;

    public function onConstruct()
    {
        $this->messages = new Messages();
        $this->view->setTemplateAfter('main');
    }
}
