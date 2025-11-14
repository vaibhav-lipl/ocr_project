@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="row">

    <!-- Total Users Card -->
    <div class="col-md-6 mt-3">
        <div class="card shadow-sm p-3 bg-white rounded text-center">
            <h5 class="text-secondary mb-2">Total Users</h5>
            <h2 class="fw-bold">{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="card shadow-sm p-3 bg-white rounded text-center">
            <h5 class="text-secondary mb-2">Total Scans</h5>
            <h2 class="fw-bold">{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="card shadow-sm p-3 bg-white rounded text-center">
            <h5 class="text-secondary mb-2">Approved Scans</h5>
            <h2 class="fw-bold">{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="card shadow-sm p-3 bg-white rounded text-center">
            <h5 class="text-secondary mb-2">ReTacked Scans</h5>
            <h2 class="fw-bold">{{ $totalUsers }}</h2>
        </div>
    </div>

</div>

@endsection