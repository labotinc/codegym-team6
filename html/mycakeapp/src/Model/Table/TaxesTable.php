<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Taxes Model
 *
 * @property \App\Model\Table\PaymentsTable&\Cake\ORM\Association\HasMany $Payments
 *
 * @method \App\Model\Entity\Tax get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tax newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tax[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tax|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tax saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tax patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tax[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tax findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TaxesTable extends Table
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

        $this->setTable('taxes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Payments', [
            'foreignKey' => 'tax_id',
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
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->integer('tax_rate')
            ->requirePresence('tax_rate', 'create')
            ->notEmptyString('tax_rate');

        $validator
            ->date('adaptation_date')
            ->requirePresence('adaptation_date', 'create')
            ->notEmptyDate('adaptation_date');

        $validator
            ->date('end_date')
            ->allowEmptyDate('end_date');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        return $validator;
    }
}
