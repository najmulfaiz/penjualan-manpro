@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('warning'))
<div class="alert alert-warning">{{ session('warning') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('danger') }}</div>
@endif

@if(session('errors'))
<div class="alert alert-danger">
    <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
