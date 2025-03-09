@section('title', 'E-TRAK - Home')
<x-layout>
    <div class="text-center">
        <h1 class="display-4">Welcome</h1>
        <p>This is a new project of the <strong>Employment Monitoring System</strong></p>
    </div>

    <div class="text-center">
        <a href="https://lookerstudio.google.com/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE?fbclid=IwY2xjawGZXIlleHRuA2FlbQIxMAABHWw1eJ0SY4OlJju7W9T7gV5eNEVFGy5QgPEYOM0jkeni293iDCwtfhtkkQ_aem_jBd-8gTDT5g2pEeWlbhpFQ" 
            class="btn btn-primary mb-2" target="_blank">Dashboard</a>
        <br>
        <a href="{{ route('view-records') }}" class="btn btn-primary mb-2">View Records</a>
        <br>
        <a href="" class="btn btn-primary mb-4">Import Excel File</a>
    </div>
</x-layout>