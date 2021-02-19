<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $reservation_id
 * @property int $tax_id
 * @property int $card_id
 * @property int $ticket_id
 * @property int $discount_id
 * @property int $total_payments
 * @property bool $is_paid
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Reservation $reservation
 * @property \App\Model\Entity\Tax $tax
 * @property \App\Model\Entity\Card $card
 * @property \App\Model\Entity\Ticket $ticket
 * @property \App\Model\Entity\Discount $discount
 */
class Payment extends Entity
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
        'tax_id' => true,
        'card_id' => true,
        'ticket_id' => true,
        'discount_id' => true,
        'total_payments' => true,
        'is_paid' => true,
        'is_deleted' => true,
        'created' => true,
        'modified' => true,
        'reservation' => true,
        'tax' => true,
        'card' => true,
        'ticket' => true,
        'discount' => true,
    ];
}
