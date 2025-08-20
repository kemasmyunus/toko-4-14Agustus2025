<?php
include "../koneksi.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>POS Kasir</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #000000;
        }
        .header {
            background: #f5f5f5;
            color: #000000;
            padding: 16px 24px;
            font-size: 22px;
            font-weight: bold;
            border-bottom: 1px solid #e0e0e0;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #f5f5f5;
            padding: 0;
            border-right: 1px solid #e0e0e0;
            min-height: 100vh;
        }
        .sidebar ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .sidebar li {
            margin: 0;
        }
        .sidebar a {
            display: block;
            color: #000000;
            text-decoration: none;
            padding: 14px 24px;
            border-left: 4px solid transparent;
        }
        .sidebar a.active, .sidebar a:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
        .main-content {
            flex: 1;
            background: #ffffff;
            padding: 32px 40px;
        }
        .form-pos, .form-pelanggan {
            border: 1px solid #f5f5f5;
            background: #ffffff;
            padding: 20px 24px 18px 24px;
            border-radius: 4px;
            margin-bottom: 24px;
        }
        .form-pos {
            width: 60%;
            margin-right: 24px;
        }
        .form-pelanggan {
            width: 40%;
        }
        .flex-row {
            display: flex;
            gap: 24px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        select, input[type="number"], input[type="date"], input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 16px;
            border: 1px solid #f5f5f5;
            border-radius: 3px;
            background: #f5f5f5;
            color: #000000;
            font-size: 15px;
        }
        button, .btn-remove {
            background: #f5f5f5;
            color: #000000;
            border: 1px solid #e0e0e0;
            padding: 8px 18px;
            border-radius: 3px;
            font-size: 15px;
            cursor: pointer;
        }
        button:hover, .btn-remove:hover {
            background: #ffffff;
            border-left: 4px solid #000000;
            font-weight: bold;
        }
        table.table-cart {
            border-collapse: collapse;
            width: 100%;
            background: #ffffff;
            margin-bottom: 18px;
        }
        table.table-cart th, table.table-cart td {
            border: 1px solid #f5f5f5;
            padding: 8px;
            text-align: center;
            color: #000000;
        }
        table.table-cart th {
            background: #f5f5f5;
            font-weight: bold;
        }
        #tabel_diskon {
            margin-top: 12px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="header">Toko4 - POS Kasir</div>
    <div class="container">
        <nav class="sidebar">
            <ul>
                <li><a href="../barang">barang</a></li>
                <li><a href="../detail_pembelian">detail_pembelian</a></li>
                <li><a href="../detail_penjualan">detail_penjualan</a></li>
                <li><a href="../diskon">diskon</a></li>
                <li><a href="../gudang">gudang</a></li>
                <li><a href="../pegawai">pegawai</a></li>
                <li><a href="../pelanggan">pelanggan</a></li>
                <li><a href="../pembelian">pembelian</a></li>
                <li><a href="../penjualan">penjualan</a></li>
                <li><a href="../pos" class="active">pos</a></li>
                <li><a href="../rekonsiliasi">rekonsiliasi</a></li>
                <li><a href="../stok">stok</a></li>
                <li><a href="../stok_sn">stok_sn</a></li>
                <li><a href="../supplier">supplier</a></li>
                <li><a href="../batch" >batch</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <h2 style="margin-top:0;">Halaman POS</h2>
            <div class="flex-row">
                <div class="form-pos">
                    <h3>Transaksi</h3>
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
                    <label>Scan / Input Kode Barang atau IMEI/SN:</label>
                    <input type="text" id="scan_kode" placeholder="SKU/kode_barang/IMEI/SN">
                    <div id="scan_msg" style="color:red;min-height:18px;margin-bottom:8px;"></div>
                    <div id="sn_inputs" style="display:none;">
                        <label>IMEI1:</label>
                        <input type="text" id="input_imei1" placeholder="IMEI1">
                        <label>IMEI2:</label>
                        <input type="text" id="input_imei2" placeholder="IMEI2">
                        <button type="button" id="btn_add_sn">Tambah ke Keranjang</button>
                    </div>
                    <br>
                    <table class="table-cart" id="tabel_keranjang">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>IMEI/SN</th>
                                <th>IMEI1</th>
                                <th>IMEI2</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <br>
                    <label>Total:</label>
                    <input type="text" id="total" readonly><br><br>
                    <label>Bayar:</label>
                    <input type="number" id="bayar" value="0"><br><br>
                    <label>Sisa Bayar:</label>
                    <input type="text" id="sisa" readonly><br><br>
                    <button id="simpan_transaksi">Simpan Transaksi</button>
                </div>
                <div class="form-pelanggan">
                    <h3>Tambah Pelanggan Baru</h3>
                    <form id="form_pelanggan">
                        <input type="text" name="nama_pelanggan" placeholder="Nama" required><br><br>
                        <input type="text" name="kontak" placeholder="Kontak"><br><br>
                        <button type="submit">Simpan Pelanggan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
let keranjang = [];
let lastBarangSN = null; // Untuk menyimpan barang SN yang discan

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
        $("#sn_inputs").hide();
        lastBarangSN = null;
        if(!kode) return;

        $.get("get_barang.php", {kode: kode}, function(res){
            let barang = null;
            try { barang = JSON.parse(res); } catch(e) {}
            if(barang && typeof barang.sn !== "undefined") {
                if(barang.sn == "1"){
                    // Tampilkan input IMEI1 dan IMEI2
                    lastBarangSN = barang;
                    $("#sn_inputs").show();
                    $("#input_imei1").val(barang.stok_sn && barang.stok_sn.imei1 ? barang.stok_sn.imei1 : "");
                    $("#input_imei2").val(barang.stok_sn && barang.stok_sn.imei2 ? barang.stok_sn.imei2 : "");
                    $("#scan_msg").text("Barang ini ber-SN. Silakan masukkan IMEI1/IMEI2 jika ada, lalu klik Tambah ke Keranjang.");
                } else {
                    tambahKeranjang(barang, "", "", "");
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
                            let imei1 = obj.stok_sn.imei1 || "";
                            let imei2 = obj.stok_sn.imei2 || "";
                            // Pastikan barang SN
                            if(barang.sn == "1"){
                                // Cek apakah sudah di keranjang
                                let idx = keranjang.findIndex(b => b.id_barang == barang.id_barang && b.imei_sn == imei);
                                if(idx > -1){
                                    $("#scan_msg").text("IMEI/SN sudah di keranjang!");
                                } else {
                                    tambahKeranjang(barang, imei, imei1, imei2);
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

// Handler tombol tambah SN ke keranjang
$("#btn_add_sn").on("click", function(){
    if(!lastBarangSN) return;
    let imei = $("#scan_kode").val().trim();
    let imei1 = $("#input_imei1").val().trim();
    let imei2 = $("#input_imei2").val().trim();
    if(!imei){
        $("#scan_msg").text("IMEI/SN harus diisi!");
        return;
    }
    // Cek duplikat di keranjang
    let idx = keranjang.findIndex(b => b.id_barang == lastBarangSN.id_barang && b.imei_sn == imei);
    if(idx > -1){
        $("#scan_msg").text("IMEI/SN sudah di keranjang!");
        return;
    }
    tambahKeranjang(lastBarangSN, imei, imei1, imei2);
    $("#scan_kode").val("");
    $("#input_imei1").val("");
    $("#input_imei2").val("");
    $("#sn_inputs").hide();
    $("#scan_msg").text("");
    lastBarangSN = null;
});

function tambahKeranjang(barang, imei, imei1, imei2){
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
            imei1: imei1,
            imei2: imei2,
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
                imei1: "",
                imei2: "",
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
            <td>${item.imei_sn || ""}</td>
            <td>${item.imei1 || ""}</td>
            <td>${item.imei2 || ""}</td>
            <td>${item.jumlah}</td>
            <td>${total}</td>
            <td><button onclick="hapusItem(${i})" class="btn-remove">X</button></td>
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
</body>
</html>
