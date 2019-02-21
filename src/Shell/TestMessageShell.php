<?php
namespace App\Shell;

use App\Lib\Message;
use Cake\Console\Shell;

/**
 * TestMessage shell command.
 */
class TestMessageShell extends Shell
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
        $message = new Message();
        $message->reminder("447540846166", "Unconference", Message::TRACK_DESIGN, Message::FLOOR_DESIGN, new \DateTime("2019-02-22 14:45"));
        $this->out("Sent");
    }
}
