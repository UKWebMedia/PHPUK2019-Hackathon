<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Talk Entity
 *
 * @property int $id
 * @property string|null $talk_title
 * @property string|null $url_friendly_talk_title
 * @property string|null $talk_description
 * @property string|null $type
 * @property \Cake\I18n\FrozenTime|null $start_date
 * @property int|null $duration
 * @property string|null $stub
 * @property int|null $average_rating
 * @property bool|null $comments_enabled
 * @property int|null $comment_count
 * @property bool|null $starred
 * @property int|null $starred_count
 * @property array|null $speakers
 * @property array|null $tracks
 * @property int|null $track_id
 *
 * @property \App\Model\Entity\Track $track
 */
class Talk extends Entity
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
        'talk_title' => true,
        'url_friendly_talk_title' => true,
        'talk_description' => true,
        'type' => true,
        'start_date' => true,
        'duration' => true,
        'stub' => true,
        'average_rating' => true,
        'comments_enabled' => true,
        'comment_count' => true,
        'starred' => true,
        'starred_count' => true,
        'speakers' => true,
        'tracks' => true,
        'track_id' => true,
        'track' => true
    ];
}
