<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Movie Entity
 *
 * @property int $id
 * @property string $title
 * @property int $running_time
 * @property \Cake\I18n\Date $end_date
 * @property string $top_image_name
 * @property string $slide_image_name
 * @property \Cake\I18n\Date $release_date
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\ScreeningSchedule[] $screening_schedules
 */
class Movie extends Entity
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
        'title' => true,
        'running_time' => true,
        'end_date' => true,
        'top_image_name' => true,
        'slide_image_name' => true,
        'release_date' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'screening_schedules' => true,
    ];
}
