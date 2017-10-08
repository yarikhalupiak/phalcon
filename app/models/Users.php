<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

class Users extends Model
{


    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new UniquenessValidator([
                'message' => 'Sorry, The email was registered by another user'
            ]));

        return $this->validate($validator);
    }

    public function saveUser($request)
    {
        $name = $request->getPost('name', array('string', 'striptags'));
        $email = $request->getPost('email', 'email');
        $password = $request->getPost('password');

        $this->password = sha1($password);
        $this->name = $name;
        $this->email = $email;
        $this->created_at = new Phalcon\Db\RawValue('now()');
        $this->admin = false;
        $this->save();

   }


}
