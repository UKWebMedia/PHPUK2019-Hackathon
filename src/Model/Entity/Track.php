<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Track Entity
 *
 * @property int $id
 * @property int|null $event_id
 * @property string|null $track_name
 * @property string|null $track_description
 * @property int|null $talks_count
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Talk[] $talks
 */
class Track extends Entity
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
        'event_id' => true,
        'track_name' => true,
        'track_description' => true,
        'talks_count' => true,
        'event' => true,
        'talks' => true
    ];
}
