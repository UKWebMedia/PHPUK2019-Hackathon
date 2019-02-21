<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Events Model
 *
 * @property \App\Model\Table\TracksTable|\Cake\ORM\Association\HasMany $Tracks
 *
 * @method \App\Model\Entity\Event get($primaryKey, $options = [])
 * @method \App\Model\Entity\Event newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Event[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Event|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Event patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Event[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Event findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EventsTable extends Table
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

        $this->setTable('events');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Tracks', [
            'foreignKey' => 'event_id'
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('url_friendly_name')
            ->maxLength('url_friendly_name', 255)
            ->requirePresence('url_friendly_name', 'create')
            ->allowEmptyString('url_friendly_name', false);

        $validator
            ->dateTime('start_date')
            ->requirePresence('start_date', 'create')
            ->allowEmptyDateTime('start_date', false);

        $validator
            ->dateTime('end_date')
            ->requirePresence('end_date', 'create')
            ->allowEmptyDateTime('end_date', false);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('stub')
            ->maxLength('stub', 255)
            ->allowEmptyString('stub');

        $validator
            ->scalar('href')
            ->maxLength('href', 255)
            ->allowEmptyString('href');

        $validator
            ->scalar('tz_continent')
            ->maxLength('tz_continent', 255)
            ->allowEmptyString('tz_continent');

        $validator
            ->scalar('tz_place')
            ->maxLength('tz_place', 255)
            ->allowEmptyString('tz_place');

        $validator
            ->integer('attendee_count')
            ->allowEmptyString('attendee_count');

        $validator
            ->boolean('attending')
            ->allowEmptyString('attending');

        $validator
            ->integer('event_average_rating')
            ->allowEmptyString('event_average_rating');

        $validator
            ->integer('event_comments_count')
            ->allowEmptyString('event_comments_count');

        $validator
            ->integer('tracks_count')
            ->allowEmptyString('tracks_count');

        $validator
            ->integer('talks_count')
            ->allowEmptyString('talks_count');

        $validator
            ->scalar('icon')
            ->maxLength('icon', 255)
            ->allowEmptyString('icon');

        $validator
            ->scalar('location')
            ->maxLength('location', 255)
            ->allowEmptyString('location');

        $validator
            ->allowEmptyFile('images');

        $validator
            ->allowEmptyString('tags');

        return $validator;
    }
}
