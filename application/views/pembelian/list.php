<section class="pt-5">
    <div class="container">
        <h2 class="pb-5 center">Daftar Pembelian</h2>
        <div class="right mb-3">
            <div class="d-flex justify-content-between mb-3">
                <h4 id="harga_total"></h4>
                <button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url().'pembelian/add'; ?>';">+ Tambah Pembelian</button>
            </div>
        </div>
        <table id="example" class="display table" style="width:100%">
        <thead>
            <tr>
                <th class="center">Produk</th>
                <th class="center">Harga</th>
                <th class="center">Jumlah</th>
                <th class="center">Nama Supplier</th>
                <th class="center">Dibuat Pada</th>
                <th class="center">Status</th>
                <?php if(isset($_SESSION['user_type'])){ ?>
                    <?php if($_SESSION['user_type']=='petugas'){ ?>
                        <th class="center">Aksi</th>
                    <?php } ?>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php 
            $total=0;
            foreach($pembelian as $row){ 
                $total += $row->harga*$row->jumlah; 
        ?>
            <tr>
                <td><?php echo $row->nama_produk ?></td>
                <td>Rp. <?php echo number_format($row->harga,0,",",".") ?></td>
                <td><?php echo $row->jumlah ?></td>
                <td><?php echo $row->nama_supplier ?></td>
                <td><?php echo $row->created_on ?></td>
                <td><?php if($row->batal==0) echo 'Aktif'; else echo 'Batal'; ?></td>
                <?php if(isset($_SESSION['user_type'])){ ?>
                    <?php if($_SESSION['user_type']=='petugas'){ ?>
                        <td>
                            <?php if($row->batal==0) { ?>
                            <button type="button" class="btn btn-danger" onclick="if(confirm('Anda yakin ?')== true) window.location.href='<?php echo base_url() ?>pembelian/cancel/<?php echo $row->id ?>';">Batalkan</button>
                            <?php } ?>
                        </td>
                    <?php } ?>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </div>
    </table>
</section>

<script>
    $("#harga_total").text('Total : Rp. <?php echo number_format($total,0,",","."); ?>');
</script>