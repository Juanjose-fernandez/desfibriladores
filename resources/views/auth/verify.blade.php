@extends('layouts.default')

@section('styles')

    <style>
        #left-panel{
            display: none;
        }
    </style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un nuevo link de verificación ha sido enviado a tu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, revise link de verificación en su email.') }}

                    {{ __('Si no has recibido el email') }}, <a href="{{ route('verification.resend') }}">{{ __('click aqui para recibir uno nuevo.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
