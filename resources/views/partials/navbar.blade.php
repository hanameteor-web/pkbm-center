<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl">

    <div class="container-fluid py-1 px-3">

        <h6 class="font-weight-bolder mb-0">
            Dashboard PKBM
        </h6>

        <div class="ms-auto">

            <strong>{{ auth()->user()->name }}</strong>

            <small class="text-muted">
                ({{ ucfirst(auth()->user()->role) }})
            </small>

        </div>

    </div>

</nav>