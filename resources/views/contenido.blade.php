<!-- @extends('principal') -->
@extends('app')
@section('contenido')
    @if(Auth::check())
        @if(Auth::user()->name === 'admin')
            <template v-if="menu == 0">
                <admin_datos></admin_datos>
            </template>
            <template v-if="menu == 1">
                <admin_categoria></admin_categoria>
            </template>
        @else
            <template v-if="menu == 0">
                <datos></datos>
            </template>
            <template v-if="menu == 1">
                <enviar_datos></enviar_datos>
            </template>
        @endif
    @endif
@endsection