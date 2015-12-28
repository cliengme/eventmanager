@extends('layouts.base')

@section('navcontent')
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Eventmanager</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">

                <li><a href="{{url('/logout')}}">Logout <i class="glyphicon glyphicon-log-out"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
@endsection

@section('events')
<div class="row">

    <div class="col-md-10 col-md-offset-1 main">
        <h1 class="page-header">Evénements</h1>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($events as $event)
            <div class="panel panel-default event">
                <div class="panel-heading" role="tab">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{$event->id}}" aria-expanded="false" aria-controls="collapseTwo">
                            {{date('d.m.Y', strtotime($event->date))}} : {{$event->name}} à {{$event->place}}
                        </a>

                    </h4>
                </div>
                <div id="{{$event->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$event->id}}">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Situation géographique</h3>
                                <p class="location hidden">{{$event->place}}</p>
                                <div id='map{{$event->id}}'></div>



                            </div>


                            <div class="col-md-6">
                                <h3>Invités <small>({{count($event->guests)}}/{{$event->capacity}})</small></h3>
                                <div class="row">
                                    @foreach ($event->guests as $guest)

                                    @if ($guest->gender === 'male')


                                    <div class="col-xs-6 col-md-3">

                                        <a href="#" class="thumbnail" data-toggle="tooltip" title="{{$guest->first_name}} {{$guest->last_name}}">

                                            <img src="img/boy{{rand(1,6)}}.png" alt="...">
                                        </a>
                                    </div>

                                    @else

                                    <div class="col-xs-6 col-md-3">

                                        <a href="#" class="thumbnail" data-toggle="tooltip" title="{{$guest->first_name}} {{$guest->last_name}}">

                                            <img src="img/girl{{rand(1,6)}}.png" alt="...">
                                        </a>
                                    </div>
                                    @endif

                                    @endforeach

                                    @if ($event->capacity > count($event->guests))
                                    <div class="col-xs-6 col-md-3">
                                        <a href="#" class="thumbnail open-guestModal"  title="Inviter" data-toggle="modal" data-id="{{$event->id}}" data-target="#guestForm">

                                            <img src="img/add.png" alt="...">
                                        </a>
                                    </div>
                                    @endif


                                </div>


                            </div>
                        </div> 

                    </div>

                </div>
            </div>



            @endforeach

            <div class="panel panel-default">
                <button style="width: 100%;"  type="button" class="btn btn-success" data-toggle="modal" data-target="#eventForm">Nouveau</button>
            </div>

        </div>




        <!-- Modal for guests -->
        <div id="guestForm" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Inviter une personne à cet événement</h4>
                    </div>
                    <div class="modal-body">

                        <form role="form" data-toggle="validator" method="POST" action="{{url('/events/addguest')}}">
                            <input type="hidden" name="eventId" id="eventId" value=""/>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="first_name">Prénom</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Prénom" data-error="Ce champ est obligatoire !" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Nom</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Nom" data-error="Ce champ est obligatoire !" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="adresse@email.com" data-error="Ce champ est obligatoire et demande une adresse e-mail valide." required>
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" value="male" required>
                                        Homme
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" value="female" required>
                                        Femme
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>



        <!-- Modal for Events -->
        <div id="eventForm" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ajout d'un nouvel événement</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" data-toggle="validator" method="POST" action="{{action('EventController@store')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="eventname">Nom de l'événement</label>
                                <input type="text" name="name" class="form-control" id="eventname" placeholder="Nom" data-error="Ce champ est obligatoire !" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="eventdate">Date</label>
                                <input type="date" name="date" class="form-control" id="eventdate" placeholder="28.12.2015" data-error="Ce champ est obligatoire ! Le format requis est JJ.MM.AAAA." required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="city">Ville</label>
                                <input type="text" name="place" class="form-control" id="city" placeholder="Ville" data-error="Ce champ est obligatoire !" required>
                                <div class="help-block with-errors"></div>
                            </div>


                            <div class="form-group">
                                <label for="capacity">Nombre de places</label>
                                <input type="number" name="capacity" min="0" max="10" class="form-control" id="capacity" placeholder="Capacité" data-error="Ce champ est obligatoire et doit être compris entre 0 et 10." required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <button type="submit" class="btn btn-success">Créer</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>


    </div>
</div>
@endsection

