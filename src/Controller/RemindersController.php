<?php
/**
 * Created by PhpStorm.
 * User: davidyell
 * Date: 2019-02-21
 * Time: 14:42
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

        $event = $this->Events->find()
            ->contain([
                'Tracks' => [
                    'Talks'
                ]
            ])
            ->where(['id' => 1])
            ->first();

        if ($this->getRequest()->is('post')) {

        }

        $this->set('event', $event);
    }
}
