@extends('layouts.app')

@section('content')
    <form action="/api/consultas" method="post">
        {{ csrf_field() }}
        Type: <input type="text" name="type" id="type">
        To_id: <input type="text" name="to_id" id="to_id">
        consulta: <input type="text" name="consulta" id="consulta">
        from_id: <input type="text" name="from_id" id="from_id">
        <button type="submit" value="enviar">
        enviar
        </button>

    </form>
    @endsection