<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReservedSeat Entity
 *
 * @property int $id
 * @property int $reservation_id
 * @property int $screening_schedule_id
 * @property string $seat
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Reservation $reservation
 * @property \App\Model\Entity\ScreeningSchedule $screening_schedule
 */
class ReservedSeat extends Entity
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
        'reservation_id' => true,
        'screening_schedule_id' => true,
        'seat' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'reservation' => true,
        'screening_schedule' => true,
    ];
}
