<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index(){
        $search = request('search');
        if($search){
            $events = Event::where([
                ['titulo', 'like', '%'.$search.'%']
            ])->get();
        }else {
            $events = Event::all();
        }

        return view('welcome', compact('events', 'search'));
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){
        $event = new Event;
        $event->titulo = $request->titulo;
        $event->data = $request->data;
        $event->descricao = $request->descricao;
        $event->local = $request->local;
        $event->privado = $request->privado;
        $event->privado = ($event->privado == "sim"? 1 :0);

        //JSON
        $event->itens = json_encode($request->itens);


        //Upload de imagem
        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $requestImagem = $request->imagem;
            $extension = $requestImagem->extension();

            $nomeImagem = md5($requestImagem->getClientOriginalName().strtotime("now")).".". $extension;

            //salvando so servidor
            $request->imagem->move(public_path('img/events'), $nomeImagem);
            $event->imagem =$nomeImagem;
        }
        $event->save();

        //Flash Messages
        return redirect('/')->with('msg', 'Evento criado com sucesso');
    }

    public function edit($id){
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id){
        $event = Event::findOrFail($id);
        $event->titulo = $request->input('titulo');
        $event->descricao = $request->input('descricao');
        $event->local = $request->input('local');
        $event->privado = $request->input('privado');
        $event->privado = ($event->privado == "sim"? 1:0);

        $event->save();
        return redirect('/');
    }

    public function show($id){
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

}
