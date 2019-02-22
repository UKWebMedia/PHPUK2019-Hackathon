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
    const FLOOR_WORKSHOP = "In another building";

    const TRACK_DESIGN = "Design Track";
    const TRACK_VELOCITY = "Velocity Track";
    const TRACK_MAIN = "Main Track";
    const TRACK_MENTION_ME = "Mention Me Track";
    const TRACK_CHIP = "Chip Track";
    const TRACK_SOCIAL = "Social";
    const TRACK_WORKSHOP = "Workshop Track";

    const FLOORS = [
        self::TRACK_DESIGN => self::FLOOR_DESIGN,
        self::TRACK_VELOCITY => self::FLOOR_VELOCITY,
        self::TRACK_MAIN => self::FLOOR_MAIN,
        self::TRACK_MENTION_ME => self::FLOOR_MENTION_ME,
        self::TRACK_SOCIAL => self::FLOOR_SOCIAL,
        self::TRACK_CHIP => self::FLOOR_CHIP,
        self::TRACK_WORKSHOP => self::FLOOR_WORKSHOP,
    ];

    /** @var Client */
    private $client;

    function __construct()
    {
        $this->generateClient();
    }

    public function reminder(string $phoneNumber, string $talkName, string $track, \DateTime $startTime): bool
    {
        $difference = $startTime->diff(new \DateTime());

        if ($difference->format("%h")) {
            $minutes = $difference->format('%h hours and %i minutes');
        } else {
            $minutes = $difference->format('%i minutes');
        }

        if (isset(self::FLOORS[$track])) {
            $floor = self::FLOORS[$track];
        } else {
            $floor = self::FLOOR_MENTION_ME;
        }

        $message = $this->client->message()->send([
            'to' => $phoneNumber,
            'from' => 'Reminder Service',
            'text' => 'Reminder: "' .$talkName . '" is starting in ' . $minutes . '. The room is "' . $track . '" which can be found on ' . $floor . " floor.",
        ]);

        return true;
    }

    private function generateClient()
    {
        $creds = new \Nexmo\Client\Credentials\Basic(env('NEXMO_API_KEY'), env('NEXMO_API_SECRET'));
        $this->client = new Client($creds);
    }
}
