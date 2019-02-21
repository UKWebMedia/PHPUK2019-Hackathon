<?php

namespace App\Lib;

use Nexmo\Client;

class Message
{
    /** @var Client */
    private $client;

    function __construct()
    {
        $this->generateClient();
    }

    public function reminder(string $phoneNumber, string $talkName, string $track, string $floor, \DateTime $startTime)
    {
        $difference = $startTime->diff(new \DateTime());
        $minutes = $difference->format('%i');

        $message = $this->client->message()->send([
            'to' => $phoneNumber,
            'from' => 'Reminder Service',
            'text' => 'Reminder: "' .$talkName . '" is starting in ' . $minutes . ' minutes. The room is "' . $track . '" which can be found on ' . $floor . ".",
        ]);
    }

    private function generateClient()
    {
        $creds = new \Nexmo\Client\Credentials\Basic(env('NEXMO_API_KEY'), env('NEXMO_API_SECRET'));
        $this->client = new Client($creds);
    }
}
