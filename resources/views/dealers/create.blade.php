@extends('layouts.app')

@section('title', 'Add Dealer')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-shop me-2"></i>Register New Dealer</h5>
                    <a href="{{ route('dealers.index') }}" class="btn btn-light btn-sm"><i class="bi bi-arrow-left"></i>
                        Back</a>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('dealers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Dealer Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="Enter name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Shop/Business Name</label>
                                <input type="text" name="shop_name"
                                    class="form-control @error('shop_name') is-invalid @enderror"
                                    value="{{ old('shop_name') }}" placeholder="Enter shop name">
                                @error('shop_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Email Address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="dealer@email.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Phone Number</label>
                                <input type="text" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                    placeholder="+91 XXXX XXXX">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label small fw-bold">Business Address</label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                    rows="3">{{ old('address') }}</textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">District</label>
                                    <input type="text" name="district" class="form-control rounded-3"
                                        placeholder="Enter district">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">State</label>
                                    <input type="text" name="state" class="form-control rounded-3"
                                        placeholder="Enter state">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Pin Code</label>
                                    <input type="text" name="pincode" class="form-control rounded-3"
                                        placeholder="XXXXXX">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">GST No.</label>
                                    <input type="text" name="gst_no" class="form-control rounded-3"
                                        placeholder="22AAAAA0000A1Z5">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">PAN No.</label>
                                    <input type="text" name="pan_no" class="form-control rounded-3"
                                        placeholder="ABCDE1234F">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Valid From</label>
                                    <input type="date" name="valid_from" class="form-control rounded-3">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold">Valid Till</label>
                                    <input type="date" name="valid_till" class="form-control rounded-3">
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="reset" class="btn btn-light px-4 me-2">Reset</button>
                            <button type="submit" class="btn btn-primary px-4">Register Dealer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection