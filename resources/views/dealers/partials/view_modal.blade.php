<div class="modal fade" id="viewDealerModal{{ $dealer->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Size ko LG kiya hai taaki information clear dikhe --}}
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- Header with Profile Banner --}}
            <div class="modal-header border-0 pb-0 bg-primary bg-gradient position-relative" style="height: 120px;">
                <div class="position-absolute w-100 text-center" style="bottom: -50px; left: 0;">
                    <div class="mx-auto bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold shadow"
                        style="width: 100px; height: 100px; font-size: 2.5rem; border: 6px solid white;">
                        {{ substr($dealer->name, 0, 1) }}
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body pt-5 mt-4">
                <div class="text-center mb-4">
                    <h4 class="fw-bold mb-1 text-dark">{{ $dealer->name }}</h4>
                    <p class="text-primary fw-medium mb-2"><i class="bi bi-shop me-1"></i>{{ $dealer->shop_name }}</p>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-bold">
                       ID: {{ $dealer->dealer_id_custom }}
                    </span>
                </div>

                <div class="row g-3 px-lg-4">
                    {{-- Section: Contact Details --}}
                    <div class="col-12 mt-4">
                        <h6 class="fw-bold text-uppercase small text-muted border-bottom pb-2 mb-3">
                            <i class="bi bi-person-lines-fill me-2"></i>Contact Information
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light-subtle h-100">
                            <small class="text-muted d-block mb-1 fw-bold text-uppercase" style="font-size: 0.65rem;">Email Address</small>
                            <span class="text-dark d-block"><i class="bi bi-envelope me-2 text-primary"></i>{{ $dealer->email }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light-subtle h-100">
                            <small class="text-muted d-block mb-1 fw-bold text-uppercase" style="font-size: 0.65rem;">Phone Number</small>
                            <span class="text-dark d-block"><i class="bi bi-telephone me-2 text-primary"></i>{{ $dealer->phone }}</span>
                        </div>
                    </div>

                    {{-- Section: Tax & Legal --}}
                    <div class="col-12 mt-4">
                        <h6 class="fw-bold text-uppercase small text-muted border-bottom pb-2 mb-3">
                            <i class="bi bi-shield-check me-2"></i>Tax & Compliance
                        </h6>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light-subtle">
                            <small class="text-muted d-block mb-1 fw-bold text-uppercase" style="font-size: 0.65rem;">GST Number</small>
                            <span class="text-dark fw-bold">{{ $dealer->gst_no ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light-subtle">
                            <small class="text-muted d-block mb-1 fw-bold text-uppercase" style="font-size: 0.65rem;">PAN Number</small>
                            <span class="text-dark fw-bold">{{ $dealer->pan_no ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light-subtle">
                            <small class="text-muted d-block mb-1 fw-bold text-uppercase" style="font-size: 0.65rem;">Authorization</small>
                            @if(\Carbon\Carbon::parse($dealer->valid_till)->isPast())
                                <span class="badge bg-danger rounded-pill">Expired</span>
                            @else
                                <span class="badge bg-success rounded-pill">Valid</span>
                            @endif
                        </div>
                    </div>

                    {{-- Section: Validity & Location --}}
                    <div class="col-md-6 mt-4">
                        <h6 class="fw-bold text-uppercase small text-muted border-bottom pb-2 mb-3">
                            <i class="bi bi-calendar-range me-2"></i>Validity Period
                        </h6>
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-muted">Issued On:</small>
                                <span class="small fw-bold">{{ date('d M, Y', strtotime($dealer->valid_from)) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <small class="text-muted">Expires On:</small>
                                <span class="small fw-bold text-primary">{{ date('d M, Y', strtotime($dealer->valid_till)) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <h6 class="fw-bold text-uppercase small text-muted border-bottom pb-2 mb-3">
                            <i class="bi bi-geo-alt me-2"></i>Primary Location
                        </h6>
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <span class="small text-dark d-block mb-1">{{ $dealer->address }}</span>
                            <span class="badge bg-secondary-subtle text-secondary small">{{ $dealer->district }}, {{ $dealer->state }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 p-4 pt-2">
                <div class="d-flex w-100 gap-2">
                    <button type="button" class="btn btn-light flex-grow-1 rounded-3 fw-bold" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('dealers.certificate', $dealer->id) }}" target="_blank" class="btn btn-warning flex-grow-1 rounded-3 fw-bold text-dark">
                        <i class="bi bi-patch-check me-1"></i> Certificate
                    </a>
                    <a href="{{ route('dealers.edit', $dealer->id) }}" class="btn btn-primary flex-grow-1 rounded-3 fw-bold">
                        <i class="bi bi-pencil-square me-1"></i> Edit Dealer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>