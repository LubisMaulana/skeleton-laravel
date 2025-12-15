@extends('layouts.footer')
@section('sidebar')
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="{{ asset('/assets/images/logo.png') }}" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text">{{ config('app.name') }}</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-first-page'></i>
            </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
            <li class="menu-label">Home</li>
            <li class="{{ $page == 'Home' ? 'mm-active' : '' }}">
                <a href="{{ route('home') }}">
                    <div class="parent-icon"><i class='bx bx-home'></i>
                    </div>
                    <div class="menu-title">Home</div>
                </a>
            </li>

            @can('spv')
                <li class="menu-label">Data Management</li>
                <li class="{{ $page == 'Pengguna' ? 'mm-active' : '' }}">
                    <a href="{{ route('users') }}">
                        <div class="parent-icon"><i class='lni lni-users'></i>
                        </div>
                        <div class="menu-title">Pengguna</div>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
@endsection
