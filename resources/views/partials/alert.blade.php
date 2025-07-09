@if (session('success'))
    <div class="alert flex items-center justify-between bg-green-100 text-green-800 p-3 rounded mb-4 animate-fade">
        <span>{{ session('success') }}</span>
        <button type="button" onclick="closeAlert(this)" class="font-bold px-2">×</button>
    </div>
@endif

@if (session('error'))
    <div class="alert flex items-center justify-between bg-red-100 text-red-800 p-3 rounded mb-4 animate-fade">
        <span>{{ session('error') }}</span>
        <button type="button" onclick="closeAlert(this)" class="font-bold px-2">×</button>
    </div>
@endif