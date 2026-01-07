@extends('layouts.dashboard')

@section('content')
    <main class="content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Admin Dashboard</h1>
            <p class="page-subtitle">Active Session</p>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Followers</div>
                <div class="stat-value">0</div>
                <div class="stat-period">6 Last Year</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Add to Cart</div>
                <div class="stat-value">0</div>
                <div class="stat-period">6 Last Year</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total Students</div>
                <div class="stat-value">0</div>
                <div class="stat-period">6 Last Year</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Manage Records</div>
                <div class="stat-value">0</div>
                <div class="stat-period">6 Last Year</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Instructions</div>
                <div class="stat-value">0</div>
                <div class="stat-period">6 Last Year</div>
            </div>
        </div>

        <!-- Operational Log -->
        <div class="operational-log">
            <div class="log-header">
                <h2 class="log-title">📋 Operational Log</h2>
            </div>
            <table class="log-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Requested By</th>
                        <th>View Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>30/12/2025<br>04:39pm</td>
                        <td>Via Principal</td>
                        <td><a href="#" class="view-details">View Details</a></td>
                    </tr>
                    <tr>
                        <td>30/12/2025<br>04:30pm</td>
                        <td>Via Principal</td>
                        <td><a href="#" class="view-details">View Details</a></td>
                    </tr>
                    <tr>
                        <td>30/12/2025<br>View Details</td>
                        <td>Via Principal</td>
                        <td><a href="#" class="view-details">View Details</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </main>
@endsection
