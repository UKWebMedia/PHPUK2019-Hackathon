<?php
namespace App\Shell;

use App\Lib\Message;
use App\Model\Entity\Reminder;
use Cake\Console\Shell;
use Cake\Log\Log;
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
            ->contain(['Talks'])
            ->where([
                'Talks.start_date >=' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'Talks.start_date <=' => date('Y-m-d H:i:s')
            ]);

        if ($reminders->isEmpty()) {
            $this->abort('No reminders found.');
        }

        $messageSender = new Message();

        /** @var Reminder $reminder */
        foreach ($reminders as $reminder) {
            $talk = $reminder->talk;
            $start =  new \DateTime($talk->start_date->format(\DateTime::ATOM));

            $number = $this->formatNumber($reminder->phone_number);

            $success = $messageSender->reminder($number, $talk->talk_title, $reminder->talk->tracks[0]['track_name'], $start);

            if ($success) {
                $this->success('✅ Sent reminder message.');
                $this->Reminders->delete($reminder);
            } else {
                $this->err('❌ Sent reminder message.');
            }
        }

        $this->out('👍 All done.');
    }

    /**
     * Format numbers into E.164 format
     *
     * @see https://developer.nexmo.com/voice/voice-api/guides/numbers
     * @param string $telephoneNumber
     * @return string
     */
    private function formatNumber(string $telephoneNumber)
    {
        if (substr($telephoneNumber, 0, 1) == 0) {
            $telephoneNumber = ltrim($telephoneNumber, 0);
            $telephoneNumber = '44' . $telephoneNumber;

            return $telephoneNumber;
        }

        return $telephoneNumber;
    }
}
