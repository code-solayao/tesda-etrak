@section('title', 'E-TRAK - Import Excel file')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/import-excel-file/style.css') }}">
@endsection

<x-layout>
    <div class="container">
        <h1 class="display-4 mb-4">Import Excel File for Graduates</h1>
        <form action="{{ route('import-excel-file') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control mb-2" required />
            <input type="submit" class="btn btn-primary" name="import" value="Import" />
            <a href="{{ route('e-trak') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</x-layout>