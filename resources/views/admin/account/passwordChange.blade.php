@extends('admin.layouts.master')

@section('title','Change Password')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        @if (session('failPass'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i>{{session('failPass')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('successPass'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i>{{session('successPass')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <form action="{{route('admin#changePassword')}}" method="post" novalidate="novalidate">
                            @csrf
                            <div>
                                <div class="form-group">
                                <label class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Old password...">
                                @error('oldPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter New password...">
                                @error('newPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="control-label mb-1">Comfirm Password</label>
                                <input id="cc-pament" name="comfirmPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Confirm password...">
                                @error('comfirmPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-key"></i>
                                </button>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
