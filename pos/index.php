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
        <label>Scan / Input Kode Barang atau IMEI/SN:</label>
        <input type="text" id="scan_kode" placeholder="SKU/kode_barang/IMEI/SN">
        <div id="scan_msg" style="color:red;min-height:18px;margin-bottom:8px;"></div>
        <br>

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
        let kode = $(this).val().trim();
        $("#scan_msg").text(""); // reset pesan
        if(!kode) return;

        $.get("get_barang.php", {kode: kode}, function(res){
            let barang = null;
            try { barang = JSON.parse(res); } catch(e) {}
            if(barang && typeof barang.sn !== "undefined") {
                if(barang.sn == "1"){
                    $("#scan_msg").text("Barang ini ber-SN. Silakan masukkan IMEI/SN (imei1/imei2) pada kolom scan.");
                } else {
                    tambahKeranjang(barang, "");
                    $("#scan_kode").val("");
                }
            } else {
                // Jika tidak ditemukan di barang, cek ke stok_sn (IMEI/SN)
                $.get("get_imei_barang.php", {imei: kode}, function(res2){
                    if(res2){
                        let obj = JSON.parse(res2);
                        if(obj.barang && obj.stok_sn){
                            let barang = obj.barang;
                            let imei = obj.stok_sn.imei_sn;
                            // Pastikan barang SN
                            if(barang.sn == "1"){
                                // Cek apakah sudah di keranjang
                                let idx = keranjang.findIndex(b => b.id_barang == barang.id_barang && b.imei_sn == imei);
                                if(idx > -1){
                                    $("#scan_msg").text("IMEI/SN sudah di keranjang!");
                                } else {
                                    tambahKeranjang(barang, imei);
                                    $("#scan_kode").val("");
                                    $("#scan_msg").text(""); // hapus pesan jika berhasil input IMEI/SN
                                }
                            }
                        } else {
                            $("#scan_msg").text("IMEI/SN tidak ditemukan!");
                        }
                    } else {
                        $("#scan_msg").text("Kode/IMEI/SN tidak ditemukan!");
                    }
                });
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

    if(barang.sn == "1"){
        let index = keranjang.findIndex(b => b.id_barang == barang.id_barang && b.imei_sn == imei);
        if(index > -1){
            $("#scan_msg").text("IMEI/SN sudah di keranjang!");
            return;
        }
        keranjang.push({
            ...barang, 
            imei_sn: imei, 
            jumlah: 1,
            potongan_list: potonganList,
            total_potongan: totalPotongan
        });
    } else {
        let index = keranjang.findIndex(b => b.id_barang == barang.id_barang && b.imei_sn == "");
        if(index > -1){
            keranjang[index].jumlah += 1;
        } else {
            keranjang.push({
                ...barang, 
                imei_sn: "", 
                jumlah: 1,
                potongan_list: potonganList,
                total_potongan: totalPotongan
            });
        }
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
    renderDiskonTable();
    hitungTotal();
}

function hapusItem(i){
    if (keranjang[i].sn == "1" || keranjang[i].jumlah == 1) {
        keranjang.splice(i, 1);
    } else {
        keranjang[i].jumlah -= 1;
    }
    renderKeranjang();
}

function renderDiskonTable(){
    let html = `<table class="table-cart"><thead><tr>
        <th>Nama Barang</th><th>Diskon</th>
    </tr></thead><tbody>`;
    let totalPotongan = 0;
    keranjang.forEach(item => {
        if(item.potongan_list && item.potongan_list.length > 0){
            item.potongan_list.forEach(pot => {
                html += `<tr>
                    <td>${item.nama_barang}</td>
                    <td>${pot.nama_potongan}: Rp${pot.nilai_potongan}</td>
                </tr>`;
                totalPotongan += parseInt(pot.nilai_potongan) * item.jumlah;
            });
        }
    });
    html += `<tr><td><b>Total Potongan</b></td><td><b>Rp${totalPotongan}</b></td></tr>`;
    html += "</tbody></table>";
    $("#tabel_diskon").remove();
    $(html).attr("id","tabel_diskon").insertAfter("#tabel_keranjang");
}

function hitungTotal(){
    let totalHarga = keranjang.reduce((sum, item) => sum + (item.harga_jual_default * item.jumlah), 0);
    let totalPotongan = keranjang.reduce((sum, item) => sum + (item.total_potongan * item.jumlah), 0);
    let totalAkhir = totalHarga - totalPotongan;
    $("#total").val(totalAkhir);
    let bayar = parseInt($("#bayar").val()) || 0;
    $("#sisa").val(totalAkhir - bayar);
}

$("#bayar").on("input", hitungTotal);

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
