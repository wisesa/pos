<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
    <?php
        if (isset($_SESSION['message'])) { ?>
        <?php if (strtolower($_SESSION['type']) == 'success') { ?>
            //Toastr Message
            toastr.success('<?php echo $_SESSION['message'] ?>', '<?php echo $_SESSION['title'] ?>', {
                timeOut: 3000
            });
        <?php } elseif (strtolower($_SESSION['type']) == 'warning') { ?>
            //Toastr Message
            toastr.warning('<?php echo $_SESSION['message'] ?>', '<?php echo $_SESSION['title'] ?>', {
                timeOut: 3000
            });
        <?php } elseif (strtolower($_SESSION['type']) == 'error') { ?>
            //Toastr Message
            toastr.error('<?php echo $_SESSION['message'] ?>', '<?php echo $_SESSION['title'] ?>', {
                timeOut: 3000
            });
        <?php }
        } ?>

        $(".buttons-pdf").html("<span>Expor ke PDF</span>");
    });

    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'pdfHtml5'
        ]
    } );
    $('.js-example-basic-single').select2();
    $('#summernote').summernote();
</script>

<footer class="footer mt-auto py-3 bg-success">
  <div class="container center">
    <span class="text-muted white"><?php echo date("Y").' &copy; Majoo Teknologi Indonesia'; ?></span>
  </div>
</footer>
</body>
</html>