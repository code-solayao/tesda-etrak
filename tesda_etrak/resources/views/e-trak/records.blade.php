@section('title', 'E-TRAK - View records')
<x-layout>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="display-4">Data Records</h1>
            </div>
            <div class="col-6 text-end pt-3">
                <a href="" class="btn btn-primary btn-lg" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5" />
                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                    </svg> Create Entry
                </a>
                <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal" data-bs-target="#deleteAllRecordsModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                    </svg> Clear All Records
                </button>
            </div>
        </div>
    </div>
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
                
            </tbody>
        </table>
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