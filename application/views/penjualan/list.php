<section class="pt-5">
    <div class="container">
        <h2 class="pb-5 center">
        <?php if(isset($_SESSION['user_type'])){ ?>
                    <?php 
                    if($_SESSION['user_type']=='administrator'){
                        echo "Daftar Penjualan";
                    }else{
                        echo "Riwayat Transaksi";
                    }
                    ?>
        <?php } ?>
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
                <?php if(isset($_SESSION['user_type'])){ ?>
                    <?php if($_SESSION['user_type']=='administrator'){ ?>
                        <th class="center">Nama Pelanggan</th>
                    <?php } ?>
                <?php } ?>
                <th class="center">Dibuat Pada</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $total=0;
            foreach($penjualan as $row){ 
                $total += $row->harga*$row->jumlah; 
        ?>
            <tr>
                <td><?php echo $row->nama_produk ?></td>
                <td>Rp. <?php echo number_format($row->harga,0,",",".") ?></td>
                <td><?php echo $row->jumlah ?></td>
                <?php if(isset($_SESSION['user_type'])){ ?>
                    <?php if($_SESSION['user_type']=='administrator'){ ?>
                <td><?php echo $row->nama_pelanggan ?></td>
                    <?php } ?>
                <?php } ?>
                <td><?php echo $row->created_on ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </div>
    </table>
</section>

<script>
    $("#harga_total").text('Total : Rp. <?php echo number_format($total,0,",","."); ?>');
</script>