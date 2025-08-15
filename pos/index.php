<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>POS Kasir</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<h2>Halaman POS</h2>
<div class="container">
    <!-- FORM KIRI: POS -->
    <div class="form-pos">
        <h3>Transaksi</h3>

        <!-- HEADER -->
        <label>Pelanggan:</label>
        <select id="pelanggan"></select>
        <br><br>

        <label>Pegawai/Kasir:</label>
        <select id="pegawai">
            <?php
            $pg = mysqli_query($koneksi, "SELECT * FROM pegawai ORDER BY nama_pegawai");
            while($p = mysqli_fetch_assoc($pg)){
                echo "<option value='{$p['id_pegawai']}'>{$p['nama_pegawai']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>Metode Pembayaran:</label>
        <select id="metode" name="metode">
            <option value="cash">Cash</option>
            <option value="qris">QRIS</option>
            <option value="ewallet">E-Wallet</option>
            <option value="bank">Bank Transfer</option>
        </select>
        <br><br>

        <!-- INPUT BARANG -->
        <label>Scan / Input Kode Barang:</label>
        <input type="text" id="scan_kode" placeholder="SKU/kode_barang">
        <br><br>

        <table class="table-cart" id="tabel_keranjang">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>IMEI/SN</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- FOOTER -->
        <br>
        <label>Diskon (Rp):</label>
        <input type="number" id="diskon" value="0"><br><br>

        <label>Total:</label>
        <input type="text" id="total" readonly><br><br>

        <label>Bayar:</label>
        <input type="number" id="bayar" value="0"><br><br>

        <label>Sisa Bayar:</label>
        <input type="text" id="sisa" readonly><br><br>

        <button id="simpan_transaksi">Simpan Transaksi</button>
    </div>

    <!-- FORM KANAN: PELANGGAN -->
    <div class="form-pelanggan">
        <h3>Tambah Pelanggan Baru</h3>
        <form id="form_pelanggan">
            <input type="text" name="nama_pelanggan" placeholder="Nama" required><br><br>
            <input type="text" name="kontak" placeholder="Kontak"><br><br>
            <button type="submit">Simpan Pelanggan</button>
        </form>
    </div>
</div>

<script>
let keranjang = [];

// Load pelanggan
function loadPelanggan(){
    $.get("get_pelanggan.php", function(data){
        $("#pelanggan").html(data);
    });
}
loadPelanggan();

// Tambah pelanggan baru
$("#form_pelanggan").on("submit", function(e){
    e.preventDefault();
    $.post("simpan_pelanggan.php", $(this).serialize(), function(){
        loadPelanggan();
        $("#form_pelanggan")[0].reset();
    });
});

// Scan barang
$("#scan_kode").on("keypress", function(e){
    if(e.which == 13){
        e.preventDefault();
        let kode = $(this).val();
        $.get("get_barang.php", {kode: kode}, function(res){
            if(res){
                let barang = JSON.parse(res);
                if(barang.imei_required){
                    $.get("get_imei.php", {id_barang: barang.id_barang}, function(list){
                        let imei = prompt("Pilih IMEI:\n" + list);
                        if(imei){
                            tambahKeranjang(barang, imei);
                        }
                    });
                } else {
                    tambahKeranjang(barang, "");
                }
                $("#scan_kode").val("");
            } else {
                alert("Barang tidak ditemukan!");
            }
        });
    }
});

function tambahKeranjang(barang, imei){
    let totalPotongan = 0;
    let potonganList = [];
    if (barang.potongan_list && barang.potongan_list.length > 0) {
        potonganList = barang.potongan_list;
        totalPotongan = potonganList.reduce((sum, p) => sum + parseInt(p.nilai_potongan), 0);
    }

    let index = keranjang.findIndex(b => b.id_barang == barang.id_barang && b.imei_sn == imei);
    if(index > -1){
        keranjang[index].jumlah += 1;
    } else {
        keranjang.push({
            ...barang, 
            imei_sn: imei, 
            jumlah: 1,
            potongan_list: potonganList,
            total_potongan: totalPotongan
        });
    }
    renderKeranjang();
}

function renderKeranjang(){
    let html = "";
    keranjang.forEach((item, i) => {
        let totalPotonganItem = item.total_potongan * item.jumlah;
        let total = (item.harga_jual_default * item.jumlah) - totalPotonganItem;
        html += `<tr>
            <td>${item.kode_barang}</td>
            <td>${item.nama_barang}</td>
            <td>${item.harga_jual_default}</td>
            <td>${item.imei_sn}</td>
            <td>${item.jumlah}</td>
            <td>${totalPotonganItem}</td>
            <td>${total}</td>
            <td><button onclick="hapusItem(${i})">X</button></td>
        </tr>`;
    });
    $("#tabel_keranjang tbody").html(html);
    hitungTotal();
}

function hapusItem(i){
    if (keranjang[i].jumlah > 1) {
        keranjang[i].jumlah -= 1; // kurangi 1
    } else {
        keranjang.splice(i, 1); // hapus item kalau jumlah tinggal 1
    }
    renderKeranjang();
}

function hitungTotal(){
    let totalHarga = keranjang.reduce((sum, item) => sum + (item.harga_jual_default * item.jumlah), 0);
    let totalPotongan = keranjang.reduce((sum, item) => sum + (item.total_potongan * item.jumlah), 0);
    
    let diskonManual = parseInt($("#diskon").val()) || 0; // diskon tambahan manual
    
    let totalAkhir = totalHarga - totalPotongan - diskonManual;
    $("#total").val(totalAkhir);
    
    let bayar = parseInt($("#bayar").val()) || 0;
    $("#sisa").val(totalAkhir - bayar);
}

$("#diskon, #bayar").on("input", hitungTotal);

// Simpan transaksi
$("#simpan_transaksi").click(function(){
    if(!$("#pelanggan").val() || keranjang.length == 0){
        alert("Pilih pelanggan dan masukkan barang!");
        return;
    }
    $.post("simpan_transaksi.php", {
        pelanggan: $("#pelanggan").val(),
        pegawai: $("#pegawai").val(),
        metode: $("#metode").val(),
        diskon: $("#diskon").val(),
        bayar: $("#bayar").val(),
        sisa: $("#sisa").val(),
        keranjang: JSON.stringify(keranjang)
    }, function(res){
        alert(res);
        keranjang = [];
        renderKeranjang();
    }).fail(function(xhr){
        alert("Error: " + xhr.responseText);
    });
});
</script>

<style>
.container { display: flex; gap: 20px; }
.form-pos, .form-pelanggan { border: 1px solid #ccc; padding: 15px; width: 50%; }
</style>
</body>
</html>
