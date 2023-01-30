@extends('layouts.app')

@section('title', 'Document')
@section('document', 'active')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Document</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Document</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Document Table</h3>
                            <button onclick="addData()" type="button" class="btn btn-primary float-right"
                                data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus">
                                </i>
                                Create
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Document
                                        </th>
                                        <th>
                                            Sign
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                        <th class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    <h4 class="modal-title">Document</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="form-document">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="string" class="form-control" placeholder="Title" name="title"
                                    id="title">
                            </div>
                            <div class="form-group">
                                <label for="document">Document</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="content" name="content"
                                            accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, application/pdf, image/*">
                                        {{-- <label class="custom-file-label" for="document">Choose document</label> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="signing">Signing</label>
                                <div id="sig" class="border"></div>
                                <button type="button" class="btn btn-default btn-sm" id="clear">Clear</button>
                                <textarea class="d-none" name="signin64" id="signin64"></textarea>
                                <br>
                                <span>-- Or Upload Your Signin Instead --</span>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="signin" name="signin">
                                        {{-- <label class="custom-file-label" for="signin">Choose signin</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    <button type="submit" id="submitBtn" class="btn btn-primary" onclick="storeData()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="{{ asset('assets/css/jquery.signature.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.5/axios.min.js"></script>

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/dist/js/jquery.signature.js') }}"></script>

    {{-- Endpoints --}}
    <input type="hidden" name="route-document-index" id="route-document-index" value="{{ route('api.document.index') }}">
    <input type="hidden" name="route-document-store" id="route-document-store" value="{{ route('api.document.store') }}">
    <input type="hidden" name="route-document-update" id="route-document-update"
        value="{{ route('api.document.update') }}">
    {{-- <input type="hidden" name="route-document-store" id="route-document-store" value="{{ route('api.document.update') }}"> --}}
@endpush

@push('styles')
    <style>
        .kbw-signature {
            width: 400px;
            height: 200px;
        }

        #sig canvas {
            width: 100% !important;
            height: auto;
        }
    </style>
@endpush

@include('layouts.script')

@push('scripts')
    <script>
        $(function() {
            window.sig = $('#sig').signature({
                syncField: '#signin64',
                syncFormat: 'PNG'
            });
            $('#disable').click(function() {
                var disable = $(this).text() === 'Disable';
                $(this).text(disable ? 'Enable' : 'Disable');
                sig.signature(disable ? 'disable' : 'enable');
            });
            $('#clear').click(function() {
                window.sig.signature('clear');
                $('#signin64').val('');
            });
            // $('#json').click(function() {
            //     alert(sig.signature('toJSON'));
            // });
            // $('#svg').click(function() {
            //     alert(sig.signature('toSVG'));
            // });
        });
    </script>

    <script>
        let datas = [];
        let action = '';

        $(function() {
            // window.dataTable = $('#myTable').DataTable({
            //     dom: 'Bfrtip',
            //     paging: true,
            //     searching: true,
            //     buttons: [
            //         'copy', 'csv', 'excel', 'pdf', 'print'
            //     ]
            // });
            initializeTable();
            getData();
        });

        function initializeTable() {
            window.dataTable = $('#myTable').DataTable({
                dom: 'Bfrtip',
                paging: true,
                searching: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }

        async function getData() {
            if (event) {
                event.preventDefault();
            }
            await window.dataTable.destroy();

            try {
                const result = await axios.get($('#route-document-index').val());

                if (result.data.data) {
                    datas = result.data.data;
                    let html = '';
                    let d = '';
                    for (let index = 0; index < datas.length; index++) {
                        d = datas[index];
                        d.content = d.content.replace('localhost', 'localhost:8000');
                        d.signing = d.signing.replace('localhost', 'localhost:8000');
                        console.log(d);
                        html +=
                            `
                            <tr>
                                <td>${index+1}</td>
                                <td>${d.title}</td>
                                <td>
                                    <span>${d.content}</span>
                                <td>
                                    <img style="max-height:100px;" src="${d.signing}" alt="${d.title} Signing">
                                </td>
                                <td>${d.created_at}</td>
                                <td class="project-actions text-center">
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a onclick="editData(${index})" class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a onclick="deleteData(${index})" class="btn btn-danger btn-sm" href="#">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                    `;
                    }
                    await $('#myTable').find('tbody').html(html);

                    initializeTable();
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

        async function addData() {
            if (event) {
                event.preventDefault();
            }
            action = 'add';

            $('#modal-default').modal('show');
            $('#title').val('');
            window.sig.signature('clear');
            $('#signin64').val('');
        }

        async function editData(index) {
            if (event) {
                event.preventDefault();
            }
            $('#modal-default').modal('show');
            action = 'edit';
            let data = datas[index];
            $('#title').val(data.title);
        }

        async function updateData() {
            const formData = new FormData();

            let content = $('#content')[0];
            content = content.files[0] || '';
            let signin = $('#signin')[0];
            signin = signin.files[0] || '';

            formData.append("title", $('#title').val());
            formData.append("content", content);
            formData.append("signin64", $('#signin64').val());
            formData.append("signin", signin);
            formData.append("_method", "PATCH");

            try {
                const result = await axios.post($('#route-document-update').val() + '/' + index, formData);
                location.reload();
            } catch (error) {
                if (error.response.status === 422) {
                    setErrors(error, form);
                }
            }
        }
    </script>
@endpush
