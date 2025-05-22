<section class="content-header">
      <h1>
        Tambah
        <small>Kategori</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Kategori</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class = "box">
            <div class = "box-header">
            <h3 class="box-title">Barcode Generator</h3>
            <div class="col card-hader text-right">
                <a href="<?=site_url('item')?>" class="btn btn-warning btn-sm">
                   <i class="fa fa-undo"></i>  Kembali
                </a>
        </div>
        </div>
        <div class="box-body">
            <?php
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '">';
        ?>
        <br>
        <?=$row->barcode?>
          </div>
        </div>
      
    </section>