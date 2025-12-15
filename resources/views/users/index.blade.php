@extends('layouts.sidebar')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    @include('assets.css.components.datatable')
    @include('assets.css.components.select2')
    @include('assets.css.users.index')
    <style>
        #ActivatedExpiredUser label {
            white-space: nowrap;
        }

        @media only screen and (max-width: 580px) {
            #ActivatedExpiredUser label {
                white-space: wrap;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container card radius-10 p-4 mb-0">
        <div class="d-flex ps-0 gap-2 mb-4 justify-content-between pe-0">
            <div class="d-flex flex-wrap align-items-center w-100">
                <div class="breadcrumb-title pe-3">{{ config('app.name') }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="ms-auto">
                <button type="button" class="btn btn-primary p-2 pt-0 pb-0" data-bs-toggle="modal"
                    data-bs-target="#modalAdd">
                    <i class="bx bx-plus w-100"></i>
                </button>
            </div>
        </div>

        <div class="table-responsive small" style="padding: 0 12px;">
            <table id="table-data" class="table table-striped m-0" style="width:100%">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" hidden></th>
                        <th style="color:white;">Nama</th>
                        <th style="color:white;">Email</th>
                        <th style="color:white;">Role</th>
                        <th style="color:white;"></th>
                    </tr>
                </thead>
                <tbody id="body-table">
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Edit Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Nama"
                                required>
                            <label for="edit_name">Nama</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="edit_email" name="email" placeholder="Email"
                                readonly>
                            <label for="edit_email">Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="edit_role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="OPR">OPR</option>
                                <option value="SPV">SPV</option>
                            </select>
                            <label for="edit_role">Role</label>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control pe-5" id="edit_password" name="password" placeholder
                                required>

                            <label for="edit_password">Password</label>

                            <i class="bx bx-show position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                id="toggle-password-icon" onclick="showOrHidePassword('#edit_password')"></i>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control pe-5" id="edit_password_confirmation"
                                name="password_confirmation" placeholder required>

                            <label for="edit_password_confirmation">Konfirmasi Password</label>

                            <i class="bx bx-show position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                id="toggle-password-confirm-icon"
                                onclick="showOrHidePassword('#edit_password_confirmation', '#toggle-password-confirm-icon')"></i>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddLabel">Tambah Peserta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="formAdd" action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="add_name" name="name" placeholder
                                required>
                            <label for="add_name">Nama</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="add_email" name="email" placeholder
                                required>
                            <label for="add_email">Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="add_role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="OPR">OPR</option>
                                <option value="SPV">SPV</option>
                            </select>
                            <label for="add_role">Role</label>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control pe-5" id="add_password" name="password"
                                placeholder required>

                            <label for="add_password">Password</label>

                            <i class="bx bx-show position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                id="toggle-password-icon" onclick="showOrHidePassword('#add_password')"></i>
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control pe-5" id="add_password_confirmation"
                                name="password_confirmation" placeholder required>

                            <label for="add_password_confirmation">Konfirmasi Password</label>

                            <i class="bx bx-show position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"
                                id="toggle-password-confirm-icon"
                                onclick="showOrHidePassword('#add_password_confirmation', '#toggle-password-confirm-icon')"></i>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalForDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Konfirmasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="mb-3 mt-3">
                                <label for="name" class="form-label gap-0" required>Ketik Ulang "<span
                                        class="m-0 text-primary" id="konfirmasi"></span>"</label>
                                <input class="form-control border-dark" type="text" id="name" name="name"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <a class="btn btn-secondary" data-bs-dismiss="modal"
                            style="width: 30%; height: 40px; min-width: 95px;">Close</a>
                        <button type="submit" class="btn btn-danger"
                            style="width: 30%; height: 40px; min-width: 95px;">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const URL_GET_USERS = "{{ route('get.users') }}";
        const URL_SHOW_USERS = "{{ route('users.show', ['id' => '__id__']) }}";
        const URL_UPDATE_USERS = "{{ route('users.update', ['id' => '__id__']) }}";
        const URL_DELETE_USERS = "{{ route('users.destroy', ['id' => '__id__']) }}";
    </script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    @include('assets.js.users.index')
@endsection
