<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tax Entity
 *
 * @property int $id
 * @property int $tax_rate
 * @property \Cake\I18n\Date $adaptation_date
 * @property \Cake\I18n\Date|null $end_date
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Payment[] $payments
 */
class Tax extends Entity
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
        'tax_rate' => true,
        'adaptation_date' => true,
        'end_date' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'payments' => true,
    ];
}
