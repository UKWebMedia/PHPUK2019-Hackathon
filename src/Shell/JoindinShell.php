<?php
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Http\Client;

/**
 * Joindin shell command.
 *
 * @property \App\Model\Table\EventsTable $Events
 * @property \App\Model\Table\TracksTable $Tracks
 * @property \App\Model\Table\TalksTable $Talks
 */
class JoindinShell extends Shell
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

        $parser->addSubcommand('event');
        $parser->addSubcommand('tracks');
        $parser->addSubcommand('talks');

        return $parser;
    }

    public function event()
    {
        $apiUrls['event'] = 'https://api.joind.in/v2.1/events/7001';

        $this->loadModel('Events');

        $this->out('Fetching event data from Joind.in');
        $client = new Client();
        $eventData = $client->get($apiUrls['event'])->getJson()['events'][0];

        $event = $this->Events->newEntity($eventData, ['validate' => false]);

        if ($this->Events->save($event)) {
            $this->success('Event saved successfully');
        } else {
            $this->err('Event could not be saved.');
        }
    }

    public function tracks()
    {
        $apiUrls['tracks'] = 'https://api.joind.in/v2.1/events/7001/tracks';

        $this->loadModel('Tracks');

        $this->out('Fetching tracks data from Joind.in');
        $client = new Client();
        $tracksData = $client->get($apiUrls['tracks'])->getJson()['tracks'];

        $tracks = $this->Tracks->newEntities($tracksData);
        foreach ($tracks as $i => $track) {
            $tracks[$i]->set('event_id', 1);
        }

        if ($this->Tracks->saveMany($tracks)) {
            $this->success('Tracks saved successfully');
        } else {
            $this->err('Could not save the tracks');
        }
    }

    public function talks()
    {
        $apiUrls['talks'] = 'https://api.joind.in/v2.1/events/7001/talks?resultsperpage=40';

        $this->loadModel('Talks');
        $this->loadModel('Tracks');

        $this->out('Fetching talks from Joind.in');
        $client = new Client();
        $talksData = $client->get($apiUrls['talks'])->getJson()['talks'];

        $talks = $this->Talks->newEntities($talksData);

        foreach ($talks as $talk) {
            foreach ($talk->tracks as $track) {
                $track = $this->Tracks->find()
                    ->where(['Tracks.track_name' => $track['track_name']])
                    ->first();

                $talk->set('track', $track);
            }
        }

        if ($this->Talks->saveMany($talks)) {
            $this->success('Talks saved');
        } else {
            $this->err('Talks could not be saved');
        }
    }
}
