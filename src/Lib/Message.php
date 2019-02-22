<?php

namespace App\Lib;

use Nexmo\Client;

class Message
{
    const FLOOR_DESIGN = "Sub-ground";
    const FLOOR_VELOCITY = "Sub-ground";
    const FLOOR_MAIN = "Upstairs";
    const FLOOR_MENTION_ME = "Ground";
    const FLOOR_CHIP = "Upstairs";
    const FLOOR_SOCIAL = "Social";

    const TRACK_DESIGN = "Design Track";
    const TRACK_VELOCITY = "Velocity Track";
    const TRACK_MAIN = "Main";
    const TRACK_MENTION_ME = "Mention Me Track";
    const TRACK_CHIP = "Chip Track";
    const TRACK_SOCIAL = "Social";

    const FLOORS = [
        self::TRACK_DESIGN => self::FLOOR_DESIGN,
        self::TRACK_VELOCITY => self::FLOOR_VELOCITY,
        self::TRACK_MAIN => self::FLOOR_MAIN,
        self::TRACK_MENTION_ME => self::FLOOR_MENTION_ME,
        self::TRACK_CHIP => self::FLOOR_SOCIAL,
    ];

    /** @var Client */
    private $client;

    function __construct()
    {
        $this->generateClient();
    }

    public function reminder(string $phoneNumber, string $talkName, string $track, \DateTime $startTime)
    {
        $difference = $startTime->diff(new \DateTime());
        $minutes = $difference->format('%i');

        if (isset(self::FLOORS[$track])) {
            $floor = self::FLOORS[$track];
        } else {
            $floor = self::FLOOR_MENTION_ME;
        }

        $message = $this->client->message()->send([
            'to' => $phoneNumber,
            'from' => 'Reminder Service',
            'text' => 'Reminder: "' .$talkName . '" is starting in ' . $minutes . ' minutes. The room is "' . $track . '" which can be found on ' . $floor . " floor.",
        ]);
    }

    private function generateClient()
    {
        $creds = new \Nexmo\Client\Credentials\Basic(env('NEXMO_API_KEY'), env('NEXMO_API_SECRET'));
        $this->client = new Client($creds);
    }
}
