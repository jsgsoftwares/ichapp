@extends('layouts.app')

@section('content')
    <form action="/api/messages" method="post">
        {{ csrf_field() }}
        <input type="text" name="to_id" id="to_id">
        <input type="text" name="content" id="content">
        <button type="submit" value="enviar">
        enviar
        </button>

    </form>
    @endsection