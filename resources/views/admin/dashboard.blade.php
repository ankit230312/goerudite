@extends('layouts.dashboard')

@section('content')
    <main class="container-fluid py-4">

        <!-- Page Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-8">
                <h1 class="h3 fw-bold mb-1">Admin Hub</h1>
                <p class="text-muted mb-0">Active Session</p>
            </div>
            <div class="col-4 text-end">
                <a href="{{ route('admin.rfq_inbox') }}?create=1" class=" common-btn ">RAISE CLASS-WISE RFQ</a>
            </div>
        </div>

        <!-- Stats Grid -->
        @php
            $stats = $stats ?? [
                ['label' => 'Followers', 'icon' => 'fa-user', 'value' => 0],
                ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => 0],
                ['label' => 'Total Students', 'icon' => 'fa-graduation-cap', 'value' => 0],
                ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => 0],
                ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => 0],
            ];
        @endphp
        <div class="row g-3 mb-4">
            @foreach ($stats as $s)
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="card text-center h-100 bg-white  shadow-sm">
                        <div class="card-body">
                            <i class="fas {{ $s['icon'] }} fa-2x text-orange mb-2"></i>
                            <div class="text-muted small">{{ strtoupper($s['label']) }}</div>
                            <h3 class="fw-bold mb-1 text-orange">{{ $s['value'] ?? 0 }}</h3>
                            @if (!empty($s['sub']))
                                <small class="text-muted text-orange">{{ $s['sub'] }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Operational Log -->
        <div class="row">
            <div class="col-12 lg:col-7 mb-4 lg:mb-0">
                <div class="card bg-white rounded shadow-sm">
                    <div class="card-header fw-bold d-flex align-items-center">
                        <span class="me-2">📋</span> Operational Log
                    </div>

                    <ul class="list-group list-group-flush">
                        @forelse($operationLogs as $rfq)




                            @php($isReceived = in_array($rfq->id, $acknowledgedRfqIds ?? []))

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">RFQ-{{ $rfq->id }} | {{ $rfq->school_name }}</div>
                                    <small class="text-muted">{{ $rfq->created_at->format('d-m-Y') }}</small>
                                </div>

                                <div class="text-end">

                                    @if ($rfq->action === 'responded')
                                        <span class="text-primary">
                                            Responded by: {{ $rfq->name }} ({{ ucfirst($rfq->role) }})
                                        </span>
                                    @else
                                        <span class="{{ $isReceived ? 'text-success' : 'text-warning' }}">
                                            {{ $isReceived ? 'Status: Received' : 'Status: Pending' }}
                                        </span>
                                    @endif

                                    <br>
                                    <a href="#" class="small"
                                        onclick="viewDistributorRfq({{ $rfq->id }}); return false;">
                                        View RFQ
                                    </a><br>

                                    @if ($rfq->action !== 'responded')
                                        @if (!$isReceived)
                                            <a href="javascript:void(0);" class="small text-primary"
                                                onclick="markRfqReceivedFromDashboard({{ $rfq->id }})">
                                                Received RFQ
                                            </a>
                                        @else
                                            <span class="small text-success">Received Done</span>
                                        @endif
                                    @endif
                                </div>
                            </li>

                        @empty
                            <li class="list-group-item">No records found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- <div class="col-6 lg:col-5">
                <div class="card h-100 bg-white rounded shadow-sm">
                    <div class="card-header fw-bold">
                        🚀 Send RFQ (Nearby Publications)
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Send your requirement to verified nearby publishers for best pricing and
                            faster delivery.</p>

                        <form>
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle fa-2x text-orange me-2"></i>
                                        <div>
                                            <div class="fw-bold">PRINCIPAL</div>
                                            <small class="text-success">School : VERIFIED</small>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-outline-primary mt-2">View Profile</a>
                                </div>
                                <div class="text-end">
                                    <div class="small text-muted">Nearby RFQ</div>
                                    <div class="d-flex gap-2">
                                        <select class="form-select form-select-sm">
                                            <option>State</option>
                                        </select>
                                        <select class="form-select form-select-sm">
                                            <option>City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-light p-3 rounded mb-3">
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" placeholder="Class">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm"
                                            placeholder="Class Strength (Total Quantity)">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" placeholder="Session">
                                    </div>
                                </div>
                                <div class="fw-bold mb-2">Class Books &amp; Materials</div>
                                <div class="row gx-2 gy-2" id="bookRows">

                                    <!-- Row -->
                                    <div class="row mb-1 align-items-center book-row">
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Books Name / Subject">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Preference">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" placeholder="Medium">
                                        </div>

                                        <!-- Action buttons -->
                                        <div class="col-auto">
                                            <button type="button" class="common-btn  add-row">
                                                +
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger remove-row d-none">
                                                −
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="mb-3">
                                <div class="fw-bold text-success mb-2">Quotation Sent Received</div>
                                <div class="border rounded p-4 text-center text-muted">
                                    PDF/ JPEG Format
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" id="confirmRfq" />
                                <label for="confirmRfq" class="form-label ms-1">I confirm that this RFQ will be sent only
                                    to verified nearby publishers based on my selected location.</label>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>



    </main>
@endsection
