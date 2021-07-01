@extends('layouts.app')

@section('content')

    <div class="home">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Messages</h2>
            </div>
            
        </div>

        @role('Admin')
        @include('backend.contacts.admin')
        @endrole

        @role('Teacher')
        @include('backend.contacts.teacher')
        @endrole
        
    </div>

@endsection
