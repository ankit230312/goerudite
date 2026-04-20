@extends('layouts.dashboard')

@section('content')

<main class="content">

    <div class="page-title">Manage Profile</div>

    <div class="profile-card">
{{-- @dd($profile) --}}
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
                    <label>Contact Person Name</label>
                    <input type="text" name="contact_person" value="{{ $profile->contact_person }}">
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
                    <label>Business Category</label>
                    <input type="text" name="business_category" value="{{ $profile->business_category }}">
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
                    <label>GST Number</label>
                    <input type="text" name="gst" value="{{ $profile->gst }}">
                </div>

                <div>
                    <label>PAN Number</label>
                    <input type="text" name="pan" value="{{ $profile->pan }}">
                </div>

                <div>
                    <label>PIN Code</label>
                    <input type="text" name="pincode" value="{{ $profile->pincode }}">
                </div>

                <div>
                    <label>Registration Certificate</label>
                    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png">
                    @if ($profile->document)
                        {{-- <small class="text-muted d-block mt-1">Uploaded: {{ basename($profile->document) }}</small> --}}
                        <a href="{{ asset('storage/' . $profile->document) }}" target="_blank">See Document</a>
                    @endif
                </div>
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
