@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="text-center mb-10">
        <img src="{{ asset('images/logo.png') }}" alt="TESDA Logo" class="block ml-auto mr-auto" width="200" height="200">
        <h1 class="mb-2">Welcome</h1>
        <p>This is a project of the <strong>Employment Monitoring System</strong></p>
    </div>
    <div class="text-center">
        @admin
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary inline-block">Dashboard</a>
            <a href="{{ route('admin.view-records') }}" class="btn btn-primary inline-block">View Records</a>
        @endadmin
        @user
            <a href="{{ route('dashboard') }}" class="btn btn-primary inline-block">Dashboard</a>
            <a href="{{ route('view-records') }}" class="btn btn-primary inline-block">View Records</a>
        @enduser
        @guest
            <a href="{{ route('dashboard') }}" class="btn btn-primary inline-block">Dashboard</a>
            <a href="{{ route('view-records') }}" class="btn btn-primary inline-block">View Records</a>
        @endguest
    </div>
</x-layout>