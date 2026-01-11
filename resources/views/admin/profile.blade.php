@extends('layouts.dashboard')

@section('content')

<main class="content">

    <div class="page-title">Manage Profile</div>

    <div class="profile-card">

        <!-- Header -->
        <div class="profile-header">
            <div></div>
            <div class="logo-upload">
                <div class="logo-circle"></div>
                <span class="change-logo">Change Logo</span>
            </div>
        </div>

        <!-- Form -->
        <form>

            <div class="profile-grid">
                <div>
                    <label>School Name / Institute Name</label>
                    <input type="text">
                </div>

                <div>
                    <label>School Type / Institute Type</label>
                    <input type="text">
                </div>

                <div>
                    <label>Email Address</label>
                    <input type="email">
                </div>

                <div>
                    <label>Mobile Number</label>
                    <input type="text" value="+91">
                </div>

                <div>
                    <label>Registered Address</label>
                    <input type="text">
                </div>

                <div>
                    <label>Total Students</label>
                    <input type="number">
                </div>

                <div>
                    <label>State</label>
                    <input type="text">
                </div>

                <div>
                    <label>Website Link</label>
                    <input type="text">
                </div>

                <div>
                    <label>Established In</label>
                    <input type="text">
                </div>

                <div>
                    <label>Board</label>
                    <input type="text">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password">
                </div>
            </div>

            <!-- About -->
            <div class="about-box">
                <label>About</label>
                <textarea rows="4"></textarea>
            </div>

            <!-- Footer -->
            <div class="profile-footer">
                <p class="hint">Connection Grow your network</p>
                <div class="actions">
                    <button type="button" class="btn-sm btn-outline">Edit</button>
                    <button type="submit" class="btn-sm btn-solid">Save</button>
                </div>
            </div>

        </form>

    </div>

</main>


@endsection
