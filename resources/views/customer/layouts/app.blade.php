<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyRent Multimedia</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <header>
            @include('customer.layouts.header')
        </header>

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer>
            @include('customer.layouts.footer')
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
    // Mendapatkan diskon dari data member pengguna
    var discount = {{ Auth::user()->member ? Auth::user()->member->diskon : 0 }};
    
    // Menangani event ketika modal 'sewaModal' ditampilkan
    $('#sewaModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Elemen yang memicu modal
        var productId = button.data('id'); // Mendapatkan id produk dari data atribut
        var productName = button.data('name'); // Mendapatkan nama produk dari data atribut
        var productPrice = button.data('price'); // Mendapatkan harga produk dari data atribut
        
        // Mengisi input hidden dengan nilai yang didapat
        $('#id_produk').val(productId);
        $('#nama_produk').val(productName);
        $('#total_before_discount').data('price', productPrice);
        
        // Logging untuk debugging
        console.log('Modal shown, Product ID: ' + productId + ', Name: ' + productName + ', Price: ' + productPrice);
    });

    // Menghitung total harga sewa saat tanggal penyewaan atau tanggal kembali diubah
    $('#rental_date, #return_date').on('change', function() {
        var rentalDate = new Date($('#rental_date').val());
        var returnDate = new Date($('#return_date').val());
        var diffTime = Math.abs(returnDate - rentalDate);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Menghitung jumlah hari sewa
        var hargaProdukPerHari = $('#total_before_discount').data('price');

        if (!isNaN(diffDays) && diffDays > 0) {
            // Menghitung total sebelum diskon, jumlah diskon, dan total setelah diskon
            var totalBeforeDiscount = hargaProdukPerHari * diffDays;
            var discountAmount = (discount / 100) * totalBeforeDiscount;
            var totalAfterDiscount = totalBeforeDiscount - discountAmount;
            
            // Mengisi input dengan nilai yang dihitung
            $('#total_before_discount').val(totalBeforeDiscount);
            $('#discount_info').val(`Diskon ${discount}% (Rp ${discountAmount})`);
            $('#total_discounted').val(totalAfterDiscount);

            // Logging untuk debugging
            console.log('Rental Date: ' + rentalDate);
            console.log('Return Date: ' + returnDate);
            console.log('Total Before Discount: ' + totalBeforeDiscount);
            console.log('Discount Percentage: ' + discount);
            console.log('Price After Discount: ' + totalAfterDiscount);
        } else {
            // Mengatur nilai ke nol jika tanggal tidak valid
            $('#total_before_discount').val(0);
            $('#discount_info').val('');
            $('#total_discounted').val(0);
        }
    });

    // Menangani klik tombol 'Sewa' di modal
    $('#confirmRental').click(function() {
        var form = $('#rentalForm');

        // Mengirim data form melalui AJAX
        $.ajax({
            type: 'POST',
            url: '{{ route('rent.store') }}',
            data: form.serialize(),
            success: function(response) {
                alert(response.message); // Menampilkan pesan sukses
                $('#sewaModal').modal('hide'); // Menutup modal
                console.log('Success response:', response); // Logging untuk debugging

                // Mengambil data form untuk membuat pesan WhatsApp
                var id_user = $('#id_user').val();
                var id_produk = $('#id_produk').val();
                var nama_produk = $('#nama_produk').val();
                var jaminan = $('#jaminan').val();
                var rental_date = $('#rental_date').val();
                var return_date = $('#return_date').val();
                var payment_method = $('#payment_method').val();
                var total = $('#total_discounted').val();

                // Membuat pesan WhatsApp dengan data yang diperoleh
                var message = `Hai, saya ingin menyewa produk berikut:
                Nama Produk: ${nama_produk}
                Jaminan: ${jaminan}
                Waktu Penyewaan: ${rental_date}
                Tanggal Kembali: ${return_date}
                Metode Pembayaran: ${payment_method}
                Total: Rp ${total}`;
                
                // Mengarahkan pengguna ke WhatsApp dengan pesan yang telah dibuat
                var whatsappUrl = `https://wa.me/62859184038932?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            },
            error: function(error) {
                console.log('Error response:', error); // Logging untuk debugging jika terjadi error
            }
        });
    });
});
</script>
</body>

</html>