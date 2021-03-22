<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ScreeningSchedules Model
 *
 * @property \App\Model\Table\MoviesTable&\Cake\ORM\Association\BelongsTo $Movies
 * @property \App\Model\Table\ReservedSeatsTable&\Cake\ORM\Association\HasMany $ReservedSeats
 *
 * @method \App\Model\Entity\ScreeningSchedule get($primaryKey, $options = [])
 * @method \App\Model\Entity\ScreeningSchedule newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ScreeningSchedule[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ScreeningSchedule|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ScreeningSchedule saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ScreeningSchedule patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ScreeningSchedule[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ScreeningSchedule findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ScreeningSchedulesTable extends Table
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

        $this->setTable('screening_schedules');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Movies', [
            'foreignKey' => 'movie_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('ReservedSeats', [
            'foreignKey' => 'screening_schedule_id',
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
            ->date('screening_date')
            ->requirePresence('screening_date', 'create')
            ->notEmptyDate('screening_date');

        $validator
            ->time('start_time')
            ->requirePresence('start_time', 'create')
            ->notEmptyTime('start_time');

        $validator
            ->time('end_time')
            ->requirePresence('end_time', 'create')
            ->notEmptyTime('end_time');

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
        $rules->add($rules->existsIn(['movie_id'], 'Movies'));

        return $rules;
    }
}
