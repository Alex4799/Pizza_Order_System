@extends('user.layout.master')

@section('title','Contact')

@section('contect')


        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-6 offset-3 mb-5 text-center bg-secondary p-4 rounded">

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show col-8 offset-4 mb-3" role="alert">
                        {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{route('user#contactSend')}}" method="post">
                        @csrf
                        <div class="">
                            <h1>Contact Us</h1>
                        </div>
                        <div>
                            <input type="text" class=" form-control mb-2" name="name" placeholder="Name">
                            <input type="email" class=" form-control mb-2" name="email" placeholder="Email">
                            <textarea name="message" id="" cols="30" rows="10" placeholder="Message" class=" form-control mb-2"></textarea>
                        </div>
                        <div class="">
                            <input type="submit" value="SEND" class="btn btn-info offset-10 col-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Cart End -->


@endsection

@section('scriptSourcecode')

@endsection
