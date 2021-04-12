@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('El link de verificación ha sido enviado a su correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de avanzar, por favor cheque el link de verificación.') }}
                    {{ __('Si aún no recibe el link de verificación') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aquí') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
