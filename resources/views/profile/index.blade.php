@extends('layouts.app')

@section('title', 'Profile')
@section('profile', 'active')

@php
    $names = explode(' ', session('name') ?? 'User');
    $firstName = $names[0];
@endphp

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
                                    src="https://eu.ui-avatars.com/api/?name={{ $firstName }}&size=128"
                                    alt="User profile picture" id="picture">
                            </div>

                            <br>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Name</b> <a class="float-right" id="name">Loading...</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right" id="email">Loading...</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right" id="phone">Loading...</a>
                                </li>
                            </ul>

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Company</strong>
                            <p class="text-muted" id="company">
                                Loading...
                            </p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Division</strong>
                            <p class="text-muted" id="division">
                                Loading...
                            </p>
                        </div>
                    </div>
                    <button onclick="editData()" class="btn btn-primary float-right">Update Profile</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('modals')
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="form-profile">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="company">Company</label>
                                <input type="string" class="form-control" placeholder="Company" name="company"
                                    id="company">
                            </div>
                            <div class="form-group">
                                <label for="division">Division</label>
                                <input type="string" class="form-control" placeholder="Division" name="division"
                                    id="division">
                            </div>
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                {{-- <input type="file" class="form-control" name="picture" id="picture_file"> --}}
                                <input type="file" class="form-control" id="picture_file" name="picture_file">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="submitBtn" class="btn btn-primary" onclick="storeData()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js')
    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.5/axios.min.js"></script>

    {{-- Endpoints --}}
    <input type="hidden" name="route-profile-me" id="route-profile-me" value="{{ route('api.user.me') }}">
    <input type="hidden" name="route-profile-update" id="route-profile-update" value="{{ route('api.user.update') }}">
@endpush

@include('layouts.script')

@push('scripts')
    <script>
        let data = [];
        let action = '';

        $(function() {
            getData();
        });

        async function getData() {
            if (event) {
                event.preventDefault();
            }

            try {
                const result = await axios.get($('#route-profile-me').val());

                if (result.data.data) {
                    data = result.data.data;
                    $('#name').html(data['name']);
                    $('#email').html(data['email']);
                    $('#phone').html(data['phone']);

                    if (!data.profile) {
                        $('#company').html('Not Set');
                        $('#division').html('Not Set');
                    } else {
                        $('#company').html(data.profile.company);
                        $('#division').html(data.profile.division);
                        if (data.profile.picture) {
                            $('#picture').attr('src', data.profile.picture);

                            $('input[name="picture"]').val(data.profile.picture);
                        }

                        $('input[name="company"]').val(data.profile.company);
                        $('input[name="division"]').val(data.profile.division);
                    }
                }
            } catch (error) {
                console.log(error.message);
            }
        }

        function editData() {
            action = 'edit';

            $('#modal-default').modal('show');
        }

        async function storeData() {
            if (event) {
                event.preventDefault();
            }
            resetErrors();
            $('#submitBtn').attr('disabled', true);
            $('#submitBtn').html('Loading...');

            const form = $('#form-profile');
            const formData = new FormData();

            let picture = $('#picture_file').prop('files')[0];

            formData.append('company', $('input[name="company"]').val());
            formData.append('division', $('input[name="division"]').val());
            formData.append('picture', picture);
            formData.append('_method', 'PATCH');

            console.log(formData);

            if (action === 'edit') {
                const result = await axios.post($('#route-profile-update').val(), formData);
                location.reload();
            } else {
                // 
            }
            $('#submitBtn').attr('disabled', false);
            $('#submitBtn').html('Submit');
        }
    </script>
@endpush
