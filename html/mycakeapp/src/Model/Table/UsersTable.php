<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\CardsTable&\Cake\ORM\Association\HasMany $Cards
 * @property \App\Model\Table\PointsTable&\Cake\ORM\Association\HasMany $Points
 * @property \App\Model\Table\ReservationsTable&\Cake\ORM\Association\HasMany $Reservations
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Cards', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Points', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Reservations', [
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
		$validator->provider('Custom', 'App\Model\Validation\CustomValidation');

        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->email('email',false, 'メールアドレスが間違っているようです')
            ->requirePresence('email', 'create')
            ->maxLength('email', 255)
            ->notEmptyString('email', '空白になっています');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', '空白になっています')
			->add('password', 'alphaNumeric_japanese_Check', [
				'rule' => ['alphaNumericWithJapaneseCheck'],
				'provider' => 'Custom',
				'message' => 'パスワードに使えない文字が入力されています',
				'last' => true,
			])
			->add('password', [
				'length' => [
					'rule' => ['lengthBetween', 4, 13],
					'message' => 'パスワードは4文字以上、13文字以下にしてください',
				]
			]);

		$validator
		->scalar('password_confirm')
		->maxLength('password_confirm', 255)
		->notEmptyString('password_confirm', '空白になっています')
		->add('password_confirm', [
			'compareWith' => [
				'rule' => ['compareWith', 'password'],
				'message' => 'パスワードが一致していません',
				'last' => true,
			],
			'length' => [
				'rule' => ['lengthBetween', 4, 13],
				'message' => 'パスワードは4文字以上、13文字以下にしてください'
			]
		])
		->add('password_confirm', 'alphaNumeric_japanese_Check', [
			'rule' => ['alphaNumericWithJapaneseCheck'],
			'provider' => 'Custom',
			'message' => 'パスワードに使えない文字が入力されています',
		]);

        $validator
            ->boolean('is_registered')
            ->notEmptyString('is_registered');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'そのアドレスはすでに登録されています'));

        return $rules;
    }
}
