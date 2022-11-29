@extends('layouts.smart-hr')
@section('content')
<div class="page-wrapper" id="app">
<div class="container">
    <div class="card">
        <div class="card-header">Chats</div>
        <div class="card-body">
            <chat-messages :messages="messages"></chat-messages>
        </div>
        <div class="card-footer">
            <chat-form v-on:messagesent="addMessage" :recipients="{{ $recipients }}"></chat-form>
        </div>
    </div>
</div>
</div>
@endsection
@section('custom_js')
<script src="{{ mix('/js/app.js') }}"></script>
@endsection


