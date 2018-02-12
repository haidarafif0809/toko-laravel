@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <router-view name="dashboardIndex"></router-view>
    <router-view></router-view>
</div>
@endsection
