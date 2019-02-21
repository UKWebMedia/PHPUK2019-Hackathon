<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\ORM\Query;

/**
 * Remind shell command.
 *
 * @property \App\Model\Table\RemindersTable $Reminders
 */
class RemindShell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        $this->loadModel('Reminders');

        $reminders = $this->Reminders->find()
            ->contain(['Talks']);

        // Filter all the reminders by whether the talk starts in the next five minutes
        $reminders->matching('Talks', function (Query $query) {
            return $query->where([
                'Talks.start_time >=' => date('Y-m-d H:i:s', strtotime('-5 minutes')),
                'Talks.start_time <=' => date('Y-m-d H:i:s')
            ]);
        });

        foreach ($reminders as $reminder) {
            // TODO: Send message to $reminder->phone_number via Nexmo
            $this->success('✅ Sent reminder message.');
            // TODO: Delete reminder record once sent to prevent duplicate sends, or mark record as sent
        }

        $this->out('👍 All done.');
    }
}
