@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show fw-500 fs-18px" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session('error') }}
    </div>
@endif
