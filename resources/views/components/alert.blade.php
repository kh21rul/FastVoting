@if(session('error'))
    <div class="app-alert alert alert-warning alert-dismissible fade show d-flex justify-content-between" role="alert">
        <div class="container">
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@if(session('success'))
    <div class="app-alert alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
        <div class="container">
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
