<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

    protected $table = 'events';
    protected $fillable = [
        'date',
        'place',
        'name',
        'capacity'
    ];
    public $timestamps = false;

    /**
     * La fonction events() permet de définir la relation entre les invités et les événements.
     * @return type
     */
    public function guests() {
        return $this->belongsToMany('App\Guest');
    }

    /**
     * La fonction exist($name, $date, $place) perment de vérifier si l'événement existe en BD selon ses identifiants métier.
     * @param String $name - le nom de l'événement
     * @param  date $date - la date de l'énénement
     * @param String $place - le lieu de l'événement
     * @return boolean - true si l'événement existe, false sinon
     */
    public static function exist($name, $date, $place) {
        return Event::where('name', $name)->where('date', $date)->where('place', $place)->first() !== NULL;
    }

    /**
     * La fonction existTechId($eventId) perment de vérifier si l'événement existe en BD selon son identifiant technique.
     * @param int $eventId - l'id de l'événement
     * @return boolean - true si l'événement existe, false sinon
     */
    public static function existTechId($eventId) {
        return Event::find($eventId) !== NULL;
    }

    /**
     * La fonction isSoldOut($eventId) permet de vérifier si un événement est n'est pas complet.
     * @param int $eventId - l'id de l'événement
     * @return boolean true si l'événement n'est pas complet, false sinon
     */
    public static function isNotSoldOut($eventId) {
        $event = Event::with('guests')->find($eventId);
        $guests = count($event->guests);
        if ($event->capacity == 0) {
            return FALSE;
        }
        return $event->capacity > $guests;
    }

}
