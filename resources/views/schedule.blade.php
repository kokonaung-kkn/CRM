@extends('layouts.master')

@section('schedule_link')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css"/>
@endsection

@section('content')
<div class="contents">
    <div class="content-detail mt-3">
        <div class="card mb-3">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('schedule_script')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
@endsection