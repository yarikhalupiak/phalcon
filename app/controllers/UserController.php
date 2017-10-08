<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class UserController extends ControllerBase
{

    public function indexAction()
    {
        $users = Users::find(['order' => 'id DESC']);
        $currentPage = $this->request->getQuery('page', 'int');
        $paginator = new PaginatorModel(
            [
                'data' => $users,
                'limit' => 5,
                'page' => $currentPage,
            ]
        );

        $this->view->setVars(
            [
                'users' => $users,
                'page' => $paginator->getPaginate()
            ]);
    }

    public function createAction()
    {
        $form = new UserForm;

        $this->view->setVars([
            'form' => $form,
            'action' => 'store'
        ]);

        $this->view->pick('user/form');
    }

    public function storeAction()
    {
        $this->view->disable();

        if ($this->request->isAjax() && $this->request->isPost()) {

            $user = new Users();
            $form = new UserForm;

            $data = $this->request->getPost();

            if (!$form->isValid($data, $user)) {
                return $this->messages->sendMessageJson($form);
            }

            $user->saveUser($this->request);

            if ($user->save() == false) {
                return $this->messages->sendMessageJson($user);
            }

            return $this->messages->sendMessageJson('User create');
        }
    }

    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstById($id);

            if (!$user) {
                $this->flash->error(
                    'User is not found'
                );

                return $this->dispatcher->forward(
                    [
                        "controller" => "user",
                        "action" => "index",
                    ]
                );
            }

            $this->view->setVars(['form' => new UserForm(
                $user,
                [
                    "edit" => true,
                ]
            ), 'action' => 'update']);

            $this->view->pick('user/form');

        }
    }

    public function updateAction()
    {
        $this->view->disable();


        if (!$this->request->isAjax() && !$this->request->isPost()) {

            return $this->dispatcher->forward(
                [
                    "controller" => "user",
                    "action" => "index",
                ]
            );
        }

        $id = $this->request->getPost("id", "int");
        $user = Users::findFirstById($id);

        $form = new UserForm();
        $data = $this->request->getPost();

        if (!$form->isValid($data, $user)) {
            return $this->messages->sendMessageJson($form);
        }

        $user->password = sha1($this->request->getPost('password'));

        if ($user->save() === false) {
            return $this->messages->sendMessageJson($user);
        }

        return $this->messages->sendMessageJson('User update');

    }

    public function deleteAction($id)
    {
        if ($this->request->isPost()) {

            $user = Users::findFirst($id);

            if ($user !== false) {
                if ($user->delete() === false) {
                    $this->flash->error('Sorry, we can\'t user the robot right now');
                } else {
                    $this->flash->success('The user was deleted successfully!');
                }
                return $this->dispatcher->forward(
                    [
                        "controller" => "user",
                        "action" => "index",
                    ]
                );
            }
        }
        return $this->dispatcher->forward(
            [
                "controller" => "user",
                "action" => "index",
            ]
        );
    }
}

