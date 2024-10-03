<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Daftar Invoice</title>
</head>
<body>

    @include('layout.navbar') 

    <div class="container mt-4">
        <h1 class="mb-4">Daftar Invoice</h1>
        @if($invoices->isEmpty())
            <p>Tidak ada data invoice yang tersedia.</p>
        @else

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product ID</th>
                            <th>Tripay Reference</th>
                            <th>Email Pembeli</th>
                            <th>Nomor Telepon Pembeli</th>
                            <th>Response</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->product_id }}</td>
                                <td>{{ $invoice->tripay_reference }}</td>
                                <td>{{ $invoice->buyer_email }}</td>
                                <td>{{ $invoice->buyer_phone }}</td>
                                <td>{{ $invoice->raw_response }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    
    @include('layout.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
