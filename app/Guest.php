<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model {

    protected $table = 'guests';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender'
    ];
    public $timestamps = false;

    /**
     * La fonction events() permet de définir la relation entre les invités et les événements.
     * @return type
     */
    public function events() {
        return $this->belongsToMany('App\Event');
    }

    /**
     * La fonction exist($email) permet de vérifier si l'invité existe en BD selon son identifiant métier.
     * @param type $email - l'e-mail de l'invité.
     * @return boolean - true si l'invité existe, false sinon.
     */
    public static function exist($email) {
        return Guest::where('email', $email)->first() !== NULL;
    }

    /**
     * La fonction participateToEvent($event_id, $guest_id) permet de déterminer si un invité participe à un événement donné.
     * @param type $event_id
     * @param type $guest_id
     * @return boolean - true si l'invité participe à l'événement en question, false sinon.
     */
    public static function participateToEvent($event_id, $guest_id) {
        return Eventguest::where('event_id', $event_id)->where('guest_id', $guest_id)->first() !== NULL;
    }

}
