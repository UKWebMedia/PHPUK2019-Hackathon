<?php
/**
 * Created by PhpStorm.
 * User: davidyell
 * Date: 2019-02-21
 * Time: 14:42
 *
 * @property \App\Model\Table\RemindersTable $Reminders
 * @property \App\Model\Table\EventsTable $Events
 */

namespace App\Controller;


class RemindersController extends AppController
{
    /**
     * List the events talks, and allow a user to set reminders
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->loadModel('Events');
        $this->loadModel('Reminders');

        $event = $this->Events->find()
            ->contain([
                'Tracks' => [
                    'Talks'
                ]
            ])
            ->where(['id' => 1])
            ->first();

        if ($this->getRequest()->is('post')) {
            $reminders = [];
            $phoneNumber = $this->getRequest()->getData('phone_number');
            foreach ($this->getRequest()->getData('reminders') as $talkId) {
                $reminders[] = $this->Reminders->newEntity([
                    'phone_number' => $phoneNumber,
                    'talk_id' => (int)$talkId['talk_id']
                ]);
            }

            if ($this->Reminders->saveMany($reminders)) {
                $this->Flash->success('Your reminders have been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('We could not save your reminders.');
            }
        }

        $this->set('event', $event);
    }

    /**
     * View existing reminders for a phone number
     *
     * @return \Cake\Http\Response|null
     */
    public function view()
    {
        if ($this->getRequest()->is('post')) {
            $reminders = $this->Reminders->find()
                ->contain(['Talks'])
                ->where(['phone_number' => $this->getRequest()->getData('phone_number')]);

            if ($reminders->isEmpty()) {
                $this->Flash->error('No reminders found for this phone number.');
                return $this->redirect(['action' => 'view']);
            }

            $this->set('reminders', $reminders);
        }
    }
}
