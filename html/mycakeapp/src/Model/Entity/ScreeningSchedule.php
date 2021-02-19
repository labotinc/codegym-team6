<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ScreeningSchedule Entity
 *
 * @property int $id
 * @property int $movie_id
 * @property \Cake\I18n\Date $date
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Movie $movie
 * @property \App\Model\Entity\ReservedSeat[] $reserved_seats
 */
class ScreeningSchedule extends Entity
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
        'movie_id' => true,
        'date' => true,
        'start_time' => true,
        'end_time' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'movie' => true,
        'reserved_seats' => true,
    ];
}
