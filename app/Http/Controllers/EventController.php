<?php

namespace App\Http\Controllers;

use App\Event;
use App\Guest;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * La fonction index() permet de récupérer les événements à venir de la BD et d'afficher la vue principale.
     * @return View - La vue principale permettant d'afficher tous les événements.
     */
    public function index() {
        $date_today = Carbon::now()->format('Y-m-d');
        $events = Event::with('guests')->whereDate('date', '>=', $date_today)->orderBy('date', 'asc')->get();
        return view('index')->with('events', $events);
    }

    /**
     * La fonction store(Request $request) permet d'ajouter un événement si les données sont valides et que l'événement n'existe pas encore dans la BD selon ses identifiants métiers.
     * @param Request $request - La requête contenant les paramètres.
     * @return Redirect - Une redirection avec les messages selon le bon déroulement de la fonction.
     */
    public function store(Request $request) {

        $data = $request->all();


        $validator = Validator::make($request->all(), [
                    'name' => 'required|string',
                    'date' => 'required|date',
                    'place' => 'required|string',
                    'capacity' => 'required|digits_between:0,10',
        ]);

        if ($validator->passes()) {
            if (!Event::exist($data['name'], $data['date'], $data['place'])) {
                $event = new Event();
                $event->name = $data['name'];
                $event->date = $data['date'];
                $event->place = $data['place'];
                $event->capacity = $data['capacity'];
                $event->save();
                return redirect('/events')->with('status', 'L\'événement ' . $event->name . ' a été ajouté avec succès!');
            }
            return redirect('/events')->with('error', 'Cet événement existe déjà!');
        }
        return redirect('/events')->withErrors($validator)->withInput();
    }

    /**
     * La fonction addGuest(Request $request) permet d'ajouter un invité à un événement si ce dernier existe, qu'il n'est pas complet et si les données sont valides.
     * @param Request $request - La requête contenant les paramètres.
     * @return Redirect - Une redirection avec les messages selon le bon déroulement de la fonction.
     */
    public function addGuest(Request $request) {

        $data = $request->all();

        $validator = Validator::make($request->all(), [
                    'eventId' => "required|integer",
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'email' => 'required|email',
                    'gender' => 'required|string|in:male,female',
        ]);


        if ($validator->passes()) {
            if (Event::existTechId($data['eventId'])) {

                $event = Event::find($data['eventId']);
                if (Event::isNotSoldOut($event->id)) {
                    if (!Guest::exist($data['email'])) {
                        $guest = new Guest();
                        $guest->first_name = $data['first_name'];
                        $guest->last_name = $data['last_name'];
                        $guest->email = $data['email'];
                        $guest->gender = $data['gender'];
                        $guest->save();
                    } else {
                        $guest = Guest::where('email', $data['email'])->first();
                        if (Guest::participateToEvent($data['eventId'], $guest->id)) {
                            return redirect('/events')->with('error', $guest->first_name . ' ' . $guest->last_name . ' participe déjà à l\'événement ' . $event->name);
                        }
                    }
                    $event->guests()->attach($guest->id);
                    return redirect('/events')->with('status', $guest->first_name . ' ' . $guest->last_name . ' a été ajouté à l\'événement ' . $event->name);
                }
                return redirect('/events')->with('error', 'Cet événement est complet');;
            }
            return redirect('/events')->with('error', 'Cet événement n\'existe pas');
        }
        return redirect('/events')->withErrors($validator)->withInput();
    }

}

?>