@section('title', 'E-TRAK - Record details')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('main', 'Record Details')

<x-layout>
    <div>
        <a href="#" class="btn btn-primary">
            Update              
        </a>
        <a href="{{ route('view-records') }}" class="btn btn-secondary">View</a>
        <button type="button" class="btn btn-danger py-1.5">Delete</button>
    </div>
</x-layout>