@extends('layouts.app')

@section('title', 'Edit Dealer')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-pencil-square me-2"></i>Edit Dealer Profile
                        </h5>
                        <small class="text-muted">Modify registration details for <strong>{{ $dealer->name }}</strong></small>
                    </div>
                    <a href="{{ route('dealers.index') }}" class="btn btn-light btn-sm px-3 rounded-pill">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('dealers.update', $dealer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">System Identity</label>
                                <div class="p-3 bg-light rounded-3 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <span class="small d-block text-muted">Dealer Unique ID</span>
                                            <span class="fw-bold text-primary fs-5">{{ $dealer->dealer_id_custom }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small fw-bold">Account Status</label>
                                            <select name="status" class="form-select form-select-sm rounded-pill shadow-sm">
                                                <option value="active" {{ $dealer->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $dealer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Dealer Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $dealer->name) }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Shop/Business Name</label>
                                <input type="text" name="shop_name" class="form-control @error('shop_name') is-invalid @enderror" value="{{ old('shop_name', $dealer->shop_name) }}">
                                @error('shop_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $dealer->email) }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $dealer->phone) }}">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold">District</label>
                                <input type="text" name="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district', $dealer->district) }}">
                                @error('district') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold">State</label>
                                <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $dealer->state) }}">
                                @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label small fw-bold">Pin Code</label>
                                <input type="text" name="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode', $dealer->pincode) }}">
                                @error('pincode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-primary">GST Number</label>
                                <input type="text" name="gst_no" class="form-control text-uppercase @error('gst_no') is-invalid @enderror" value="{{ old('gst_no', $dealer->gst_no) }}">
                                @error('gst_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold text-primary">PAN Number</label>
                                <input type="text" name="pan_no" class="form-control text-uppercase @error('pan_no') is-invalid @enderror" value="{{ old('pan_no', $dealer->pan_no) }}">
                                @error('pan_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Valid From</label>
                                <input type="date" name="valid_from" class="form-control @error('valid_from') is-invalid @enderror" value="{{ old('valid_from', $dealer->valid_from) }}">
                                @error('valid_from') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Valid Till (Expiry)</label>
                                <input type="date" name="valid_till" class="form-control @error('valid_till') is-invalid @enderror" value="{{ old('valid_till', $dealer->valid_till) }}">
                                @error('valid_till') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold">Full Business Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="2">{{ old('address', $dealer->address) }}</textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="text-end mt-4 border-top pt-3">
                            <button type="reset" class="btn btn-light px-4 me-2">Reset Changes</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm rounded-pill">
                                <i class="bi bi-check-circle me-1"></i> Update Dealer Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection