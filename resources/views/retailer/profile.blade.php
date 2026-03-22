@extends('layouts.dashboard')

@section('content')

<main class="content">

    <div class="page-title">Manage Profile</div>

    <div class="profile-card">

        @php
            $profileUrl = $profile->profile ? asset('storage/' . $profile->profile) : null;
        @endphp

        <!-- Header -->
        <div class="profile-header">
            <div></div>
            <div class="logo-upload">
                <div class="logo-circle" @if ($profileUrl) style="background-image:url('{{ $profileUrl }}')" @endif>
                    @if (!$profileUrl)
                        {{ strtoupper(substr($profile->business_name ?? $profile->role ?? 'U', 0, 1)) }}
                    @endif
                </div>

                    <span class="change-logo" onclick="document.getElementById('logoInput').click()">
                        Change Logo
                    </span>

            </div>
        </div>

        <!-- Form -->
        <form id="profileForm" enctype="multipart/form-data">

            <div class="profile-grid">
                <div>
                    <label>Business Name</label>
                    <input type="text" name="business_name" value="{{ $profile->business_name }}">
                </div>

                <div>
                    <label>Business Type</label>
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
                    <select name="state" data-state-select data-location-group="profile" data-selected-state="{{ $profile->state }}">
                        <option value="">Select State</option>
                    </select>
                </div>

                <div>
                    <label>City</label>
                    <select name="city" data-city-select data-location-group="profile" data-selected-city="{{ $profile->city }}">
                        <option value="">Select City</option>
                    </select>
                </div>

                <div>
                    <label>Website Link</label>
                    <input type="text" name="website_link" value="{{ $profile->website_link }}">
                </div>

                <div>
                    <label>Established In</label>
                    <input type="text" name="established" value="{{ $profile->established }}">
                </div>

                <div>
                    <label>Board</label>
                    <select name="board">
                        <option value="">Select Board</option>
                        @foreach($boards as $board)
                            <option value="{{ $board->name }}" {{ $profile->board === $board->name ? 'selected' : '' }}>
                                {{ $board->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- About -->
            <div class="about-box">
                <label>About</label>
                <textarea rows="4" name="about">{{ $profile->about }}</textarea>
            </div>
            <input type="file" name="profile" hidden id="logoInput" accept="image/*">

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

<script>
document.getElementById('profileForm').addEventListener('submit', function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('retailer.profile.update') }}", {
        method: "POST",
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status){
            Toastify({
                text: "Profile updated successfully",
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(135deg,#0f9b0f,#00ff87)"
            }).showToast();
            setTimeout(() => location.reload(), 800);
        }
    });
});
</script>

@include('partials.india-state-city-script')


@endsection
