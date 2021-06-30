@extends('layouts.main')
@section('title', 'dashboard')
@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 class="text-center">Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($events) > 0)
        <table class="table">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Participantes</th>
                        <th>Ações</th>
                    </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td scropt="row">{{$loop->index + 1}}</td>
                        <td scropt="row"><a href="/events/{{$event->id}}">{{$event->titulo}}</a></td>
                        <td scropt="row">{{count($event->users)}}</td>
                        <td>
                            <a  href="/events/edit/{{$event->id}}" class="btn btn-primary col-md-4">Editar</a>
                            <form action="/events/{{$event->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Você ainda não possui eventos, <a href="/events/create">Criar Evento</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 class="text-center">Eventos que estou participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAs) > 0)
        <table class="table">
            <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Participantes</th>
                        <th>Ações</th>
                    </tr>
            </thead>
            <tbody>
                @foreach($eventsAs as $event)
                    <tr>
                        <td scropt="row">{{$loop->index + 1}}</td>
                        <td scropt="row"><a href="/events/{{$event->id}}">{{$event->titulo}}</a></td>
                        <td scropt="row">{{count($event->users)}}</td>
                        <td>
                            <a  href="/events/edit/{{$event->id}}" class="btn btn-primary col-md-4">Sair</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Você não marcou sua presença em nenhum evento, <a href="/">Vizualizar eventos</a></p>
    @endif
</div>
@endsection
