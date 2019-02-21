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
        $message->reminder("447540846166", "Awesome PHP", "Remind Me", "Infinte Floor", new \DateTime("+5 minutes"));
        $this->out("Sent");
    }
}