<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movies Model
 *
 * @property \App\Model\Table\ScreeningSchedulesTable&\Cake\ORM\Association\HasMany $ScreeningSchedules
 *
 * @method \App\Model\Entity\Movie get($primaryKey, $options = [])
 * @method \App\Model\Entity\Movie newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Movie[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Movie|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Movie patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Movie[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Movie findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MoviesTable extends Table
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

        $this->setTable('movies');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ScreeningSchedules', [
            'foreignKey' => 'movie_id',
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
            ->scalar('title')
            ->maxLength('title', 32)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->integer('running_time')
            ->requirePresence('running_time', 'create')
            ->notEmptyString('running_time');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmptyDate('end_date');

        $validator
            ->scalar('top_image_name')
            ->maxLength('top_image_name', 255)
            ->requirePresence('top_image_name', 'create')
            ->notEmptyFile('top_image_name');

        $validator
            ->scalar('slide_image_name')
            ->maxLength('slide_image_name', 255)
            ->requirePresence('slide_image_name', 'create')
            ->notEmptyFile('slide_image_name');

        $validator
            ->date('release_date')
            ->requirePresence('release_date', 'create')
            ->notEmptyDate('release_date');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        return $validator;
    }
}
