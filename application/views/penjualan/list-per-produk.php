<section class="pt-5">
    <div class="container">
        <h2 class="pb-5 center">
        Daftar Penjualan Per Produk
        </h2>
        <div class="d-flex justify-content-between mb-3">
            <h4 id="harga_total"></h4>
        </div>

        <table id="example" class="display table" style="width:100%">
        <thead>
            <tr>
                <th class="center">Produk</th>
                <th class="center">Harga</th>
                <th class="center">Jumlah</th>
                <th class="center">Total Harga</th>
                <th class="center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $total=0;
            foreach($penjualan as $row){ 
                $total += $row->harga_total; ?>
            <tr>
                <td><?php echo $row->nama_produk ?></td>
                <td class="right">Rp. <?php echo number_format($row->harga_satuan,0,",",".") ?></td>
                <td class="right"><?php echo $row->jumlah ?></td>
                <td class="right"><?php echo number_format($row->harga_total,0,",",".") ?></td>
                <td><button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url() ?>penjualan/index?id_produk=<?php echo $row->id_produk ?>';">Lihat Detail</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </div>
    </table>
</section>

<script>
    $("#harga_total").text('Total : Rp. <?php echo number_format($total,0,",","."); ?>');
</script>