@extends('layouts.appdash')

@section('content')

    <router-view :user_id="{{auth()->id()}}" />  


 @endsection