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

@push('js')
    {{-- Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.5/axios.min.js"></script>

    {{-- Endpoints --}}
    <input type="hidden" name="route-profile-me" id="route-profile-me" value="{{ route('api.user.me') }}">
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
                }
            } catch (error) {
                console.log(error.message);
            }
        }

        async function storeData() {
            if (event) {
                event.preventDefault();
            }
            resetErrors();
            $('#submitBtn').attr('disabled', true);
            $('#submitBtn').html('Loading...');

            const form = $('#form-document');

            const formData = new FormData();

            let content = $('#content')[0];
            content = content.files[0] || '';
            let signin = $('#signin')[0];
            signin = signin.files[0] || '';

            formData.append("title", $('#title').val());
            formData.append("content", content);
            formData.append("signin64", $('#signin64').val());
            formData.append("signin", signin);

            if (action === 'edit') {
                updateData();
            } else {
                try {
                    const result = await axios.post($('#route-document-store').val(), formData);
                    // swal('Success :)', 'Order berhasil dibuat!', 'success');
                    // location.reload();
                } catch (error) {
                    if (error.response.status === 422) {
                        setErrors(error, form);
                    }
                }
            }
            $('#submitBtn').attr('disabled', false);
            $('#submitBtn').html('Submit');
        }
    </script>
@endpush
