$(document).ready(function() {
    $('#bayar').on('keyup', function() {
        let cari = $('#bayar').val();
        cari = cari.toLocaleString('id-ID');
        $('#bayar').val(cari)
    })
})

$(document).ready(function(){
    $('#loader').hide();
    $('#search').on('keyup', function(){
        $('#loader').show();
        let cari = $('#search').val();


        let dataHtml = `<div class="col-lg-4 card1 mx-auto">
        <div class="container text-center">
            <div class="card card-1" style="width: 18rem;">
                <img class="mx-auto my-4" src="img/barang/{{ $row->gambar }}"
                    alt="{{ $row->nm_barang }}" width="170">
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="font-size: 15px">{{ $row->nm_barang }}</h5>
                    <p class="card-text text-muted">Ukuran
                        {{ $row->ukuran }}
                    </p>
                </div>
                <div class="card-footer py-4">
                    <p class="text-muted fw-bold" style="font-size: 11px; text-decoration: line-through">IDR
                        {{ str_replace(',', '.', number_format($row->harga_jual + 80000)) }},-</p>
                    <p class="text-dark fw-bold" style="font-size: 15px">IDR
                        {{ str_replace(',', '.', number_format($row->harga_jual)) }},-
                    </p>
                    <a href="basket/{{ $data['id_user'] }}/{{ $row->id_barang }}"
                        class="btn btn-primary mx-auto"><i
                            class="fa-solid fa-cart-plus m-r-5 m-l-5"></i>Masukkan ke Keranjang</a>
                </div>
            </div>
        </div>
    </div>`;

        $.get('barang/find/' + cari, function(data){
            $('#barang').html(data);
            console.log("");
            $('#loader').hide();
        });
    });
});