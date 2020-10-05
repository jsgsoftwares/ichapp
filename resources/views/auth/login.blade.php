@extends('layouts.app')

@section('content')
<b-container>
    <b-row  align-h="center">
   
        <b-col cols="8">
            <b-card title="Inicio de sesion" class="my-3">
            
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
            <b-form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
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
                        required autofocus
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
                        required autofocus
                        >
                    </b-form-input>
                </b-form-group>
                <b-form-group>
                    <b-form-checkbox name="remember" {{ old('remember') ? 'checked="true"' : '' }}>
                     Recordarme
                    </b-form-checkbox>
                </b-form-group>
                <b-button type="submit" variant="primary">Iniciar sesion</b-button>
                <b-button  href="{{ route('password.request') }}" variant="link">Olvidaste tu contraseña</b-button>
               
            
            </b-form>
            </b-card>


        </b-col>

    </b-row>
</b-container>
@endsection
