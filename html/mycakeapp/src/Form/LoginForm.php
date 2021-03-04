<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class LoginForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
        return $schema
            ->addField('email', ['type' => 'string'])
            ->addField('password', ['type' => 'string']);
    }

	protected function _buildValidator(Validator $validator)
	{

		$validator
			->notEmptyString('email', '空白になっています')
			->email('email',false, 'メールアドレスが間違っています');

		$validator
			->notEmptyString('password', '空白になっています');

		return $validator;
	}

	protected function _execute(array $data)
    {
        return true;
    }
}
