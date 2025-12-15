@extends('layouts.sidebar')

@section('style')
    @include('assets.css.components.datatable')

    <style>
        .stats-card {
            border-radius: 12px;
            padding: 25px;
            background: #ffffff;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: 0.2s ease;
        }

        .stats-card:hover {
            transform: scale(1.02);
        }

        .stats-title {
            font-size: 16px;
            color: #6c757d;
        }

        .stats-value {
            font-size: 32px;
            font-weight: bold;
            color: #0d6efd;
        }

        .table-responsive #table-data td {
            color: #48a39e;
        }
    </style>
@endsection


@section('content')
    <div class="container card radius-10 p-4 mb-0">
        <div class="d-flex ps-0 gap-2 mb-4 justify-content-between pe-0">
            <div class="d-flex flex-wrap align-items-center w-100">
                <div class="breadcrumb-title pe-3 text-primary">{{ config('app.name') }}</div>

                <div class="ps-3">
                    <nav aria-label="breadcrumb" style="font-size: 18px;">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="bx bx-home-alt"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item text-primary active" aria-current="page">
                                {{ $page }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        Home
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
@endsection
