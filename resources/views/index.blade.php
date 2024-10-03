<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Produk</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-comnet</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('invoices.index') }}">Invoice</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Cari produk..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Produk</h1>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buyModal{{ $product->id }}">
                                Beli Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="buyModal{{ $product->id }}" tabindex="-1" aria-labelledby="buyModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="buyModalLabel{{ $product->id }}">Pembelian {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('create.transaction') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="sku" value="{{ $product->sku }}">
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                                    
                                    <div class="mb-3">
                                        <label for="buyer_name" class="form-label">Nama Lengkap</label>
                                        <input type="text" name="buyer_name" class="form-control" id="buyer_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="buyer_email" class="form-label">Email</label>
                                        <input type="email" name="buyer_email" class="form-control" id="buyer_email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="buyer_phone" class="form-label">Nomor Telepon</label>
                                        <input type="text" name="buyer_phone" class="form-control" id="buyer_phone" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_method" class="form-label">Pilih Metode Pembayaran</label>
                                        <select name="method" id="payment_method" class="form-select" required>
                                            <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                            <option value="mandiriva">Bank Mandiri VA</option>
                                            <option value="briva">BRIVA</option>
                                            <option value="bcava">BCA VA</option>
                                            <option value="bniva">BNI VA</option>
                                            <option value="alfamart">Alfamart QRIS</option>
                                            <option value="shopeepay">ShopeePay</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Konfirmasi Pembelian</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-4">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Kontak Kami</h5>
                    <p>
                        Nomor WhatsApp: <a href="https://wa.me/yourwhatsappphonenumber" class="text-primary">+62 123 456 789</a>
                    </p>
                </div>

                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Ikuti Kami</h5>
                    <a href="#" class="btn btn-outline-primary btn-floating m-1" role="button">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-floating m-1" role="button">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-primary btn-floating m-1" role="button">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center p-3 bg-dark text-white">
            © 2024 E-comnet Toko Peralatan Komputer
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
