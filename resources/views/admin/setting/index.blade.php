@extends('admin.body.dashboard')
@section('title')
Settings
@endsection
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Settings</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-md-2 pe-0">
                    <div class="nav nav-tabs nav-tabs-vertical" id="v-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="v-profile-tab" data-bs-toggle="pill" href="#pusher_settings" role="tab" aria-controls="pusher_settings" aria-selected="false">Pusher Settings</a>
                    </div>
                </div>
                <div class="col-7 col-md-9 ps-0">
                    <div class="tab-content tab-content-vertical border" id="v-tabContent">
                        @include('admin.setting.sections.pusher')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
