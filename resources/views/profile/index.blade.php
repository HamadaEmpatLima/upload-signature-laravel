@extends('layouts.app')

@section('title', 'Profile')
@section('profile', 'active')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('assets/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Nina Mcintire</h3>

                            <p class="text-muted text-center">Software Engineer</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Name</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right">543</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Company</strong>

                            <p class="text-muted">
                                PT Serbaguna
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Division</strong>

                            <p class="text-muted">
                                IT
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
