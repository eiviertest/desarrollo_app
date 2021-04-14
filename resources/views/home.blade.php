@extends('layouts.app')

@section('content')
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
                <enviar_dato></enviar_dato>
            </template>
        @endif
    @endif
@endsection

