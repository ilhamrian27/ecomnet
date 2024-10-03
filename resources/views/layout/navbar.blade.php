<style>
    .navbar .nav-link.active {
        font-weight: bold;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ADD8E6;"> <!-- Biru muda -->
    <div class="container-fluid">
        <a class="navbar-brand" href="#">E-comnet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('products') ? 'active font-weight-bold' : '' }}" href="{{ route('products') }}">Beranda</a> <!-- Jika aktif, menjadi bold -->
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('invoices') ? 'active font-weight-bold' : '' }}" href="{{ route('invoices.index') }}">Invoice</a> <!-- Jika aktif, menjadi bold -->
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari produk..." aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cari</button>
            </form>
        </div>
    </div>
</nav>
