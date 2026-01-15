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
        <form id="profileForm" enctype="multipart/form-data">

            <div class="profile-grid">
                <div>
                    <label>School Name / Institute Name</label>
                    <input type="text" name="business_name" value="{{ $profile->business_name }}">
                </div>

                <div>
                    <label>School Type / Institute Type</label>
                    <input type="text" name="school_type" value="{{ $profile->school_type }}">
                </div>

                <div>
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ $profile->email }}">
                </div>

                <div>
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" value="{{ $profile->mobile }}">
                </div>

                <div>
                    <label>Registered Address</label>
                    <input type="text" name="address" value="{{ $profile->address }}">
                </div>

                <div>
                    <label>Total Students</label>
                    <input type="number" name="total_students" value="{{ $profile->total_students }}">
                </div>

                <div>
                    <label>State</label>
                    <input type="text" name="state" value="{{ $profile->state }}">
                </div>

                <div>
                    <label>Website Link</label>
                    <input type="text" name="website" value="{{ $profile->website }}">
                </div>

                <div>
                    <label>Established In</label>
                    <input type="text" name="established" value="{{ $profile->established }}">
                </div>

                <div>
                    <label>Board</label>
                    <input type="text" name="board" value="{{ $profile->board }}">
                </div>
                <div>
                    <label>Password</label>
                    <input type="password">
                </div>
            </div>

            <!-- About -->
            <div class="about-box">
                <label>About</label>
                <textarea rows="4">{{ $profile->about }}</textarea>
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
