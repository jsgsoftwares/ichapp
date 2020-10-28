@extends('layouts.app')

@section('content')
<b-container>
    <b-row  align-h="center">
   
        <b-col cols="8">
            <b-card title="Registro" class="my-3">
            @if($errors->any())
            <b-alert show variant="danger">
            <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </b-alert>
            @else
            <b-alert show>Ingrese usuario y contraseña</b-alert>
            @endif
            <b-form  method="POST" action="{{ route('register') }}" id="formulario-register">
            {{ csrf_field() }}
            <b-form-group
                    label="Nombre"
                    label-for="name"
                    description="">

                    <b-form-input
                        type="text"
                        id="name"
                        placeholder="Juan Perez"
                        value="{{ old('name') }}"
                        name="name"
                        required autofocus
                        >
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    label="Correo electronico"
                    label-for="email"
                   >

                    <b-form-input
                        type="email"
                        id="email"
                        placeholder="example@123.com"
                        value="{{ old('email') }}"
                        name="email"
                        required 
                        >
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    label="Contraseña"
                    label-for="password"
                    >
                    <b-form-input
                        type="password"
                        id="password"
                        placeholder=""
                        name="password"
                        required
                        >
                    </b-form-input>
                </b-form-group>
                <b-form-group
                    label="Confirmar contraseña"
                    label-for="password-confirm"
                    >
                    <b-form-input
                        type="password"
                        id="password-confirm"
                        placeholder=""
                        name="password-confirm"
                        required
                        >
                    </b-form-input>
                </b-form-group>
                <b-button type="submit"  style="background-color:#7367f0; color:#fff" form="formulario-register" >Registrar</b-button>
                <b-button  href="{{ route('login') }}" variant="link">Ya estas registrado?</b-button>
            </b-form>
            </b-card>


        </b-col>

    </b-row>
</b-container>


           

@endsection
