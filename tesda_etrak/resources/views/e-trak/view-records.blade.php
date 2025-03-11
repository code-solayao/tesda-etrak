@section('title', 'E-TRAK - View records')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/e-trak/view-records.css') }}">
@endsection

<x-layout>
    <div class="container">
        <div class="row" style="background-color: transparent;">
            <div class="col-6 pt-4" style="background-color: transparent;">
                <h1 class="display-4">Data Records</h1>
            </div>
            <div class="col-6 text-end pt-5" style="background-color: transparent;">
                <a href="{{ route('create-record-page') }}" class="btn btn-primary" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5" />
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                    </svg> Create Record
                </a>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteAllRecordsModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                    </svg> Clear All Records
                </button>
            </div>
        </div>
        <div class="row" style="background-color: transparent;">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="" placeholder="Search record..." />
                    <input type="submit" class="btn btn-secondary input-group-text" value="Search" />
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="table-responsive table-wrapper">
                    <table class="table table-striped table-hover" id="recordsTable">
                        <thead>
                            <tr>
                                <th class="table-header">No.</th>
                                <th class="table-header">Last name</th>
                                <th class="table-header">First name</th>
                                <th class="table-header">Middle name</th>
                                <th class="table-header">Ext.</th>
                                <th class="table-header">Status of Employment</th>
                                <th class="table-header">Year of Graduation</th>
                                <th class="table-header">Qualification Title</th>
                                <th class="table-header"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($graduates as $graduate)
                            <tr>
                                <td class="table-data">{{ $graduate->id }}</td>
                                <td class="table-data">{{ $graduate->last_name }}</td>
                                <td class="table-data">{{ $graduate->first_name }}</td>
                                <td class="table-data">{{ $graduate->middle_name }}</td>
                                <td class="table-data">{{ $graduate->extension_name }}</td>
                                <td class="table-data">{{ $graduate->employment_status }}</td>
                                <td class="table-data">{{ $graduate->allocation }}</td>
                                <td class="table-data">{{ $graduate->qualification_title }}</td>
                                <td>
                                    <a href="{{ route('record-details', $graduate->id) }}" class="btn btn-secondary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
                                            <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                                        </svg> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <nav>
                <ul class="pagination">
                    @for ($i = 0; $i < 1; $i++)
                        <li class="page-item">
                            <a href="" class="page-link"></a>
                        </li>
                    @endfor
                </ul>
            </nav>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" tabindex="-1" id="deleteAllRecordsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Clear All Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>The following action cannot be undone. Are you sure to clear all records here?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" role="button" name="delete_all" value="Confirm">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>