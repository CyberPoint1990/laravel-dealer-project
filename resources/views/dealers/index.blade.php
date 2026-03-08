@extends('layouts.app')

@section('title', 'Dealer Directory')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold m-0 text-dark">Dealer Management</h4>
            <small class="text-muted">Manage and monitor your business partners</small>
        </div>
        <a href="{{ route('dealers.create') }}" class="btn btn-primary px-4 shadow-sm border-0">
            <i class="bi bi-plus-lg me-2"></i>Register New Dealer
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white py-3 border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0 fw-bold"><i class="bi bi-list-ul me-2 text-primary"></i>Dealer Directory</h6>
                </div>
                <div class="col-md-8">
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <button class="btn btn-outline-secondary btn-sm rounded-3 px-3" data-bs-toggle="modal"
                            data-bs-target="#importModal">
                            <i class="bi bi-file-earmark-arrow-up me-1"></i> Import
                        </button>

                        <a href="{{ route('dealers.index', ['export' => 'excel']) }}"
                            class="btn btn-outline-success btn-sm rounded-3 px-3">
                            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export
                        </a>

                        <a href="{{ route('dealers.index', ['print' => 'true']) }}" target="_blank"
                            class="btn btn-outline-dark btn-sm rounded-3 px-3">
                            <i class="bi bi-printer me-1"></i> Print
                        </a>

                        <form action="{{ route('dealers.index') }}" method="GET" class="ms-2">
                            <div class="input-group input-group-sm bg-light rounded-pill border px-2">
                                <input type="text" name="search" class="form-control border-0 bg-transparent py-2"
                                    placeholder="Search ID, Name, GST..." value="{{ request('search') }}">
                                <button class="btn btn-white border-0 text-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-bold">
                        <tr>
                            <th class="ps-4 py-3">Dealer ID</th>
                            <th>Dealer & Location</th>
                            <th>Tax Details (GST/PAN)</th>
                            <th>Validity Period</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dealers as $dealer)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-primary-subtle text-primary border border-primary px-3 py-2 rounded-pill fw-bold">
                                    {{ $dealer->dealer_id_custom ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                        style="width: 38px; height: 38px;">
                                        {{ substr($dealer->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $dealer->name }}</div>
                                        <div class="small text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $dealer->district }}, {{ $dealer->state }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small text-dark"><span class="text-muted small uppercase">GST:</span> <strong>{{ $dealer->gst_no ?? 'N/A' }}</strong></div>
                                <div class="small text-dark"><span class="text-muted small uppercase">PAN:</span> <strong>{{ $dealer->pan_no ?? 'N/A' }}</strong></div>
                            </td>
                            <td>
                                <div class="small text-dark fw-bold">Till: {{ date('d M, Y', strtotime($dealer->valid_till)) }}</div>
                                <div class="extra-small text-muted" style="font-size: 0.75rem;">From: {{ date('d M, Y', strtotime($dealer->valid_from)) }}</div>
                            </td>
                            <td>
                                @if($dealer->status == 'active')
                                <span class="badge bg-success-subtle text-success border border-success px-3 py-1 rounded-pill small">Active</span>
                                @else
                                <span class="badge bg-danger-subtle text-danger border border-danger px-3 py-1 rounded-pill small">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                                    <button class="btn btn-white btn-sm border-end text-info" data-bs-toggle="modal"
                                        data-bs-target="#viewDealerModal{{ $dealer->id }}" title="Quick View">
                                        <i class="bi bi-eye-fill" style="font-size: 1.1rem;"></i>
                                    </button>

                                    <a href="{{ route('dealers.certificate', $dealer->id) }}" 
                                       class="btn btn-white btn-sm border-end text-warning" 
                                       target="_blank" 
                                       title="Generate Certificate">
                                        <i class="bi bi-patch-check-fill" style="font-size: 1.1rem;"></i>
                                    </a>

                                    <a href="{{ route('dealers.edit', $dealer->id) }}"
                                        class="btn btn-white btn-sm border-end text-primary" title="Edit">
                                        <i class="bi bi-pencil-fill" style="font-size: 1.1rem;"></i>
                                    </a>

                                    <form action="{{ route('dealers.destroy', $dealer->id) }}" method="POST"
                                        id="delete-form-{{ $dealer->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-white btn-sm text-danger delete-confirm"
                                            data-id="{{ $dealer->id }}" title="Delete">
                                            <i class="bi bi-trash-fill" style="font-size: 1.1rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @include('dealers.partials.view_modal', ['dealer' => $dealer])

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-search text-muted display-4"></i>
                                <h6 class="text-muted mt-3">No dealers found matching your criteria.</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted fw-medium">
                    Showing <span class="text-dark">{{ $dealers->firstItem() }}</span> to <span
                        class="text-dark">{{ $dealers->lastItem() }}</span> of {{ $dealers->total() }} Dealers
                </small>
                <div class="pagination-rounded">
                    {{ $dealers->appends(request()->input())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Import Modal Content remains same as your original --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Import Dealers (Excel)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dealers.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <p class="small text-muted">Please upload an excel file (.xlsx) with dealer records.</p>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary px-4">Upload Now</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.delete-confirm').forEach(button => {
        button.addEventListener('click', function(e) {
            const dealerId = this.getAttribute('data-id');
            const form = document.getElementById(`delete-form-${dealerId}`);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this dealer record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#448aff', // Aapka brand primary color
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'px-4 py-2 fw-bold',
                    cancelButton: 'px-4 py-2 fw-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush