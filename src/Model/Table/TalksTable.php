<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Talks Model
 *
 * @property \App\Model\Table\TracksTable|\Cake\ORM\Association\BelongsTo $Tracks
 *
 * @method \App\Model\Entity\Talk get($primaryKey, $options = [])
 * @method \App\Model\Entity\Talk newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Talk[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Talk|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Talk|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Talk patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Talk[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Talk findOrCreate($search, callable $callback = null, $options = [])
 */
class TalksTable extends Table
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

        $this->setTable('talks');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Tracks', [
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
            ->scalar('talk_title')
            ->maxLength('talk_title', 255)
            ->allowEmptyString('talk_title');

        $validator
            ->scalar('url_friendly_talk_title')
            ->maxLength('url_friendly_talk_title', 255)
            ->allowEmptyString('url_friendly_talk_title');

        $validator
            ->scalar('talk_description')
            ->allowEmptyString('talk_description');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->allowEmptyString('type');

        $validator
            ->dateTime('start_date')
            ->allowEmptyDateTime('start_date');

        $validator
            ->integer('duration')
            ->allowEmptyString('duration');

        $validator
            ->scalar('stub')
            ->maxLength('stub', 255)
            ->allowEmptyString('stub');

        $validator
            ->integer('average_rating')
            ->allowEmptyString('average_rating');

        $validator
            ->boolean('comments_enabled')
            ->allowEmptyString('comments_enabled');

        $validator
            ->integer('comment_count')
            ->allowEmptyString('comment_count');

        $validator
            ->boolean('starred')
            ->allowEmptyString('starred');

        $validator
            ->integer('starred_count')
            ->allowEmptyString('starred_count');

        $validator
            ->allowEmptyString('speakers');

        $validator
            ->allowEmptyString('tracks');

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
        $rules->add($rules->existsIn(['track_id'], 'Tracks'));

        return $rules;
    }
}
