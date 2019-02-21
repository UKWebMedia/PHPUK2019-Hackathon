<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tracks Model
 *
 * @property \App\Model\Table\EventsTable|\Cake\ORM\Association\BelongsTo $Events
 * @property \App\Model\Table\TalksTable|\Cake\ORM\Association\HasMany $Talks
 *
 * @method \App\Model\Entity\Track get($primaryKey, $options = [])
 * @method \App\Model\Entity\Track newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Track[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Track|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Track|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Track patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Track[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Track findOrCreate($search, callable $callback = null, $options = [])
 */
class TracksTable extends Table
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

        $this->setTable('tracks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Events', [
            'foreignKey' => 'event_id'
        ]);
        $this->hasMany('Talks', [
            'foreignKey' => 'track_id'
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
            ->allowEmptyString('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('track_name')
            ->maxLength('track_name', 255)
            ->allowEmptyString('track_name');

        $validator
            ->scalar('track_description')
            ->allowEmptyString('track_description');

        $validator
            ->integer('talks_count')
            ->allowEmptyString('talks_count');

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
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['event_id'], 'Events'));

        return $rules;
    }
}
