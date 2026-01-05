@extends('layouts.app')

@section('title', 'Sign in to Your Account | GoErudite')
@section('description', 'Sign in to your GoErudite account to access digital textbooks, manage e-book services, and use secure learning tools for schools and publishers.')
@section('keywords', 'GoErudite login, GoErudite sign in, digital textbook login, school e-book portal, publisher account access')

@section('content')

        <style>
        .header {
            background-color: #EFF3F7;
            padding: 20px;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-top: 5rem;
        }

        .logo-icon {
            width: 35px;
            height: 35px;
            background-color: #ff6b35;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 600;
        }

        .logo-text span {
            color: #ff6b35;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 40px;
        }

        .user-types {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            max-width: 700px;
            margin: 0 auto;
        }

        /* CARD */
        .user-type {
            background: white;
            padding: 25px;
            border-radius: 12px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            animation: floatCard 4.5s ease-in-out infinite;
        }

        /* Alternate timing for natural feel */
        .user-type:nth-child(2) {
            animation-delay: 1.2s;
        }

        /* Hover Interaction */
        .user-type:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
        }

        /* Glow line animation */
        .user-type::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent, rgba(0, 130, 126, 0.15), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .user-type:hover::before {
            transform: translateX(100%);
        }

        /* Text animation */
        .user-type h3 {
            font-size: 18px;
            color: #000;
            margin-bottom: 6px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .user-type p {
            font-size: 13px;
            color: #000;
            transition: opacity 0.3s ease;
        }

        .user-type:hover h3 {
            color: #ff7a00;
            transform: translateX(4px);
        }

        .user-type:hover p {
            opacity: 0.85;
        }

        /* KEYFRAMES */
        @keyframes floatCard {
            0%   { transform: translateY(0); }
            50%  { transform: translateY(-6px); }
            100% { transform: translateY(0); }
        }

        /* MOBILE OPTIMIZATION */
        @media (max-width: 575px) {
            .user-types {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .user-type {
                animation: none; 
            }
        }

        .profile-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            border-radius: 8px;
        }

        /* LEFT */
        .profile-left h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .profile-left label {
            font-size: 13px;
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
        }

        .profile-left input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
        }

        /* RIGHT */
        .upload-logo {
            width: 90px;
            height: 90px;
            border: 2px dashed #dcdcdc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .upload-logo span {
            font-size: 11px;
            color: #999;
        }

        .upload-logo:hover {
            border-color: #00827e;
            background: rgba(0,130,126,0.05);
        }

        /* RESPONSIVE */
        @media (max-width: 576px) {
            .profile-box {
                flex-direction: column;
                align-items: flex-start;
            }

            .profile-right {
                align-self: center;
            }
        }

    </style>

       <div class="header">
            <div class="logo">
                <div class="logo-text"> 
                    <img src="https://i.postimg.cc/LX4qQXh4/Logo-Icon.png" alt="Header Logo" width="150">
                </div>
            </div>

            <h1 class="text-dark mb-3">Sign in to your account</h1>
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="user-types">
                <div class="user-type" onclick="showForm('administrator')">
                    <h3>Administrator</h3>
                    <p>For Principals & Admins Coaching/Institute</p>
                </div>
                <div class="user-type" onclick="showForm('distributor')">
                    <h3>Distributor</h3>
                    <p>For Warehouse Owner</p>
                </div>
                <div class="user-type" onclick="showForm('retailer')">
                    <h3>Retailer</h3>
                    <p>For Bookshop Owner</p>
                </div>
                <div class="user-type" onclick="showForm('publisher')">
                    <h3>Publisher</h3>
                    <p>For Content Creators</p>
                </div>
            </div>
        </div>

    <!-- Administrator Form -->
    <div id="administrator-form" class="form-section">
        <div class="form-header">
            <button class="back-btn" onclick="hideAllForms()">Back</button>
            <div>
                <div class="form-title">School Administrator</div>
                <div class="form-subtitle">Principals & Admins Coaching/Institute</div>
            </div>
        </div>

        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="role" value="administrator">

            <div class="profile-box">
                <div class="profile-left">
                    <h3 class="text-dark">Complete Your Profile</h3>
                </div>

                <div class="profile-right">
                    <label class="upload-logo">
                        <input type="file" name="document" hidden>
                        <span>Upload Logo</span>
                    </label>
                </div>
            </div>

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>School Name / Institute Name</label>
                    <input type="text" name="business_name" placeholder="Enter name" required>
                </div>

                <div class="form-group">
                    <label>School Type</label>
                    <select name="school_type">
                        <option value="">Select School Type</option>
                        <option value="Primary School">Primary School</option>
                        <option value="Secondary School">Secondary School</option>
                        <option value="High School">High School</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Institute Type</label>
                    <select name="institute_type">
                        <option value="">Select Institute Type</option>
                        <option value="Coaching Center">Coaching Center</option>
                        <option value="Training Institute">Training Institute</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" placeholder="+91" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>

                <div class="form-group full-width">
                    <label>Registered Address</label>
                    <textarea name="address" placeholder="Enter address"></textarea>
                </div>

                <div class="form-group">
                    <label>GST Number (If Available)</label>
                    <input type="text" name="gst" placeholder="Enter GST Number">
                </div>

                <div class="form-group">
                    <label>UDISE Code</label>
                    <input type="text" name="udise_code" placeholder="Enter UDISE Code">
                </div>

                <div class="form-group">
                    <label>PAN Number</label>
                    <input type="text" name="pan" placeholder="Example: ABCDE1234F">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" placeholder="Enter City Name">
                </div>

                <div class="form-group">
                    <label>State</label>
                    <select name="state">
                        <option value="">Select State</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Karnataka">Karnataka</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>PIN Code</label>
                    <input type="text" name="pincode" placeholder="Enter PIN Code">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="confirm" required>
                    <label>
                        I confirm that all information provided is accurate and that all commercial decisions made using the platform are my sole responsibility.
                    </label>
                </div>

            </div>

            <button type="submit" class="submit-btn">Submit Application ›</button>

            <div class="terms">
                By registering, you agree to our
                <a href="{{ url('privacy-policy') }}">Terms & Conditions</a> and
                <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </div>
        </form>

    </div>

    <!-- Distributor Form -->
    <div id="distributor-form" class="form-section">

        <div class="form-header">
            <button type="button" class="back-btn" onclick="hideAllForms()">Back</button>
            <div>
                <div class="form-title">Distributor</div>
                <div class="form-subtitle">For Warehouse Owner</div>
            </div>
        </div>

        <h2 class="text-dark mb-3">Complete Your Profile</h2>

        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="role" value="distributor">

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Contact Person Name</label>
                    <input type="text" name="contact_person" placeholder="Enter name" required>
                </div>

                <div class="form-group">
                    <label>Business / Firm Name</label>
                    <input type="text" name="business_name" placeholder="Enter Firm/Trade Name" required>
                </div>

                <div class="form-group">
                    <label>Distributor Category</label>
                    <select name="distributor_category" required>
                        <option value="">Select Category</option>
                        <option value="Books Distributor">Books Distributor</option>
                        <option value="Stationery Distributor">Stationery Distributor</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" placeholder="+91" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>

                <div class="form-group full-width">
                    <label>Registered Address</label>
                    <textarea name="address" placeholder="Enter address"></textarea>
                </div>

                <div class="form-group">
                    <label>GST Number</label>
                    <input type="text" name="gst" placeholder="Enter GST Number">
                </div>

                <div class="form-group">
                    <label>Upload Trade License <span>(Required)</span></label>
                    <input type="file" name="document" required>
                </div>

                <div class="form-group">
                    <label>PAN Number</label>
                    <input type="text" name="pan" placeholder="Example: ABCDE1234F">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" placeholder="Enter City Name">
                </div>

                <div class="form-group">
                    <label>State</label>
                    <select name="state">
                        <option value="">Select State</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Karnataka">Karnataka</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>PIN Code</label>
                    <input type="text" name="pincode" placeholder="Enter PIN Code">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="confirm" required>
                    <label>
                        I confirm that all information provided is accurate and that all commercial decisions made using the platform are my sole responsibility.
                    </label>
                </div>

            </div>

            <button type="submit" class="submit-btn">Submit Application ›</button>

            <div class="terms">
                By registering, you agree to our
                <a href="{{ url('privacy-policy') }}">Terms & Conditions</a> and
                <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </div>

        </form>
    </div>


    <!-- Retailer Form -->
    <div id="retailer-form" class="form-section">

        <div class="form-header">
            <button type="button" class="back-btn" onclick="hideAllForms()">Back</button>
            <div>
                <div class="form-title">Retailer</div>
                <div class="form-subtitle">For Bookshop Owner</div>
            </div>
        </div>

        <h2 class="text-dark mb-3">Complete Your Profile</h2>

        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="role" value="retailer">

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Shop Name</label>
                    <input type="text" name="business_name" placeholder="Enter shop name" required>
                </div>

                <div class="form-group">
                    <label>Contact Person Name</label>
                    <input type="text" name="contact_person" placeholder="Enter name" required>
                </div>

                <div class="form-group">
                    <label>Business Category</label>
                    <select name="business_category" required>
                        <option value="">Select Category</option>
                        <option value="Book Store">Book Store</option>
                        <option value="Stationery Shop">Stationery Shop</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" placeholder="+91" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>

                <div class="form-group full-width">
                    <label>Shop Address</label>
                    <textarea name="address" placeholder="Enter address"></textarea>
                </div>

                <div class="form-group">
                    <label>GST Number (If Available)</label>
                    <input type="text" name="gst" placeholder="Enter GST Number">
                </div>

                <div class="form-group">
                    <label>Trade License</label>
                    <input type="file" name="document">
                </div>

                <div class="form-group">
                    <label>PAN Number</label>
                    <input type="text" name="pan" placeholder="Example: ABCDE1234F">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" placeholder="Enter City Name">
                </div>

                <div class="form-group">
                    <label>State</label>
                    <select name="state">
                        <option value="">Select State</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Karnataka">Karnataka</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>PIN Code</label>
                    <input type="text" name="pincode" placeholder="Enter PIN Code">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="confirm" required>
                    <label>
                        I confirm that all information provided is accurate and that all commercial decisions made using the platform are my sole responsibility.
                    </label>
                </div>

            </div>

            <button type="submit" class="submit-btn">Submit Application ›</button>

            <div class="terms">
                By registering, you agree to our
                <a href="{{ url('privacy-policy') }}">Terms & Conditions</a> and
                <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </div>

        </form>
    </div>


    <!-- Publisher Form -->
    <div id="publisher-form" class="form-section">

        <div class="form-header">
            <button type="button" class="back-btn" onclick="hideAllForms()">Back</button>
            <div>
                <div class="form-title">Publisher</div>
                <div class="form-subtitle">For Content Creators</div>
            </div>
        </div>

        <h2 class="text-dark mb-3">Complete Your Profile</h2>

        <form method="POST" action="{{ route('user.register') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="role" value="publisher">

            <div class="form-grid">

                <div class="form-group full-width">
                    <label>Publishing House Name</label>
                    <input type="text" name="business_name" placeholder="Enter publisher name" required>
                </div>

                <div class="form-group">
                    <label>Contact Person Name</label>
                    <input type="text" name="contact_person" placeholder="Enter name" required>
                </div>

                <div class="form-group">
                    <label>Publisher Type</label>
                    <select name="publisher_type" required>
                        <option value="">Select Type</option>
                        <option value="Educational Publisher">Educational Publisher</option>
                        <option value="Trade Publisher">Trade Publisher</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" placeholder="+91" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>

                <div class="form-group full-width">
                    <label>Registered Address</label>
                    <textarea name="address" placeholder="Enter address"></textarea>
                </div>

                <div class="form-group">
                    <label>GST Number</label>
                    <input type="text" name="gst" placeholder="Enter GST Number">
                </div>

                <div class="form-group">
                    <label>Registration Certificate</label>
                    <input type="file" name="document">
                </div>

                <div class="form-group">
                    <label>PAN Number</label>
                    <input type="text" name="pan" placeholder="Example: ABCDE1234F">
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" placeholder="Enter City Name">
                </div>

                <div class="form-group">
                    <label>State</label>
                    <select name="state">
                        <option value="">Select State</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Karnataka">Karnataka</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>PIN Code</label>
                    <input type="text" name="pincode" placeholder="Enter PIN Code">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="confirm" required>
                    <label>
                        I confirm that all information provided is accurate and that all commercial decisions made using the platform are my sole responsibility.
                    </label>
                </div>

            </div>

            <button type="submit" class="submit-btn">Submit Application ›</button>

            <div class="terms">
                By registering, you agree to our
                <a href="{{ url('privacy-policy') }}">Terms & Conditions</a> and
                <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.
            </div>

        </form>
    </div>



@endsection

@push('scripts')
<script>
    function showForm(type) {
        // Hide all forms
        hideAllForms();
        
        // Show selected form
        const formId = type + '-form';
        document.getElementById(formId).classList.add('active');
        
        // Scroll to form
        document.getElementById(formId).scrollIntoView({ behavior: 'smooth' });
    }

    function hideAllForms() {
        const forms = document.querySelectorAll('.form-section');
        forms.forEach(form => form.classList.remove('active'));
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Prevent form submission for demo
    // document.querySelectorAll('form').forEach(form => {
    //     form.addEventListener('submit', function(e) {
    //         e.preventDefault();
    //         alert('Form submitted successfully! (Demo)');
    //     });
    // });
</script>
@endpush