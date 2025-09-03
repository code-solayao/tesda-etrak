@section('title', 'E-TRAK - Google Sheets Data')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/e-trak/google-sheets-data.js'])
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('main', 'Google Sheets Data')

<x-layout>
    <div class="mb-4">
        <form action="{{ route('admin.import-graduate') }}" method="GET" class="inline-block">
            <input type="submit" value="Import Data" class="btn btn-primary" />
        </form>
        @auth
            <a href="https://docs.google.com/spreadsheets/d/100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q/edit?gid=601902906#gid=601902906" 
            target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3.5 inline-block mb-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </a>
        @endauth
    </div>
    <div class="mb-4">
        <form action="{{ route('admin.export-graduate') }}" method="GET" class="inline-block">
            <input type="submit" value="Export Data" class="btn btn-secondary" />
        </form>
        @auth
            <a href="https://docs.google.com/spreadsheets/d/1-PlAbP1Y0dgqUEmblx3atGrjkkPWkOxrTE1qglkwfvM/edit?gid=765566487#gid=765566487" 
            target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3.5 inline-block mb-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg>
            </a>
        @endauth
    </div>
    <div class="pt-4 hidden">
        <div class="flex justify-between items-center">
            <label for="logLevel" class="mr-2 text-lg font-semibold font-sans">Filter: </label>
            <select id="logLevel" class="p-1 bg-slate-800 text-white font-mono text-sm border rounded-lg">
                <option value="all">All</option>
                <option value="error">Error</option>
                <option value="warning">Warning</option>
                <option value="info">Info</option>
            </select>
            <button id="btnClearLogs" type="button" class="btn btn-danger ml-auto mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 inline-block mb-0.5">
                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                </svg>
                Clear Logs
            </button>
        </div>
        <div id="logBox" class="p-4 overflow-x-auto overflow-y-scroll h-[770px] w-full bg-slate-800 text-white font-mono text-sm border border-gray-800 rounded-lg">
            Loading logs...
        </div>
    </div>
</x-layout>