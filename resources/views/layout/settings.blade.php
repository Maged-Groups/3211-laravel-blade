@extends('layout.base')

@section('layout')
    <!-- Header -->
    @include('components.header')

    {{-- Main --}}
    <main class="py-6">
        <div class="max-w-7xl mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Left Sidebar -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- User Profile Card -->
                    @include('components.user-profile-card')

                    <!-- Trending Topics -->
                    @include('components.trending-topics')

                    <!-- Quick Stats -->
                    @include('components.quick-stats')
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-6 space-y-6 flex flex-col">
                    @yield('main-content')
                </div>

                <!-- Right Sidebar -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Who to Follow -->

                    <!-- Trending Posts -->

                    <!-- Upcoming Events -->
                </div>
            </div>
        </div>
    </main>

@endsection