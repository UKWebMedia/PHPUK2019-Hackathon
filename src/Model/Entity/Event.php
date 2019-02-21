<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property string $url_friendly_name
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 * @property string|null $description
 * @property string|null $stub
 * @property string|null $href
 * @property string|null $tz_continent
 * @property string|null $tz_place
 * @property int|null $attendee_count
 * @property bool|null $attending
 * @property int|null $event_average_rating
 * @property int|null $event_comments_count
 * @property int|null $tracks_count
 * @property int|null $talks_count
 * @property string|null $icon
 * @property string|null $location
 * @property array|null $images
 * @property array|null $tags
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Track[] $tracks
 */
class Event extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'url_friendly_name' => true,
        'start_date' => true,
        'end_date' => true,
        'description' => true,
        'stub' => true,
        'href' => true,
        'tz_continent' => true,
        'tz_place' => true,
        'attendee_count' => true,
        'attending' => true,
        'event_average_rating' => true,
        'event_comments_count' => true,
        'tracks_count' => true,
        'talks_count' => true,
        'icon' => true,
        'location' => true,
        'images' => true,
        'tags' => true,
        'created' => true,
        'modified' => true,
        'tracks' => true
    ];
}
