@extends('admin.layouts.master')

@section('title','Contact Info')

@section('contect')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="row col">
                    <div class=" card">
                        <div class="card-title">
                            <div class=" text-decoration-none text-dark" onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></div>
                        </div>
                        <div class=" text-center card-body">
                            <h2>Contact Info</h2>
                        </div>
                        <div class=" card-body">
                            <div class="row mb-3">
                                <div class="col-2">Name</div>
                                <div class="col">{{$contact->name}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">Email</div>
                                <div class="col">{{$contact->email}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-2">Message</div>
                                <div class="col text-justify">{{$contact->message}}</div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

