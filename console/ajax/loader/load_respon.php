<?php 
include "../../../core/config/config.php";
include "../../../core/engine/controller.php";

$controller = new controller();



if(isset($_POST['date']))
{

$date = $_POST['date'];
$modelsRes = $controller->getData("GETRES_LOG");





?>


<div class="col-12">

<h4 class="header-title mb-3">Respon Code "<?= $date ?>"</h4>
    
    <div class="inbox-widget" data-simplebar style="max-height: 600px;">
        <div class="inbox-item">
            <div class="inbox-item-img">100</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Dokumen Di Terima Untuk Diproses BEA CUKAI</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>


        <div class="inbox-item">
            <div class="inbox-item-img">102</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Barang Telah Melalui Pemindai X-RAY</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>

        <div class="inbox-item">
            <div class="inbox-item-img">203</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Selesai Validasi Sistem BEA CUKAI</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>


        


        <div class="inbox-item">
            <div class="inbox-item-img">205</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Penelitian Oleh Pejabat BEA CUKAI</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>



        <div class="inbox-item">
            <div class="inbox-item-img">303</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Terbit Biling</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>


        <div class="inbox-item">
            <div class="inbox-item-img">304</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">SNPBL</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>


        <div class="inbox-item">
            <div class="inbox-item-img">306</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">SPBL</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>




        <div class="inbox-item">
            <div class="inbox-item-img">401</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Penetapan SPPBMCP ( Pembayaran & Persetujuan Keluar ), Penerima Barang Silahkan Konfirmasi Ke Penyelenggara POS/PJT</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>

        <div class="inbox-item">
            <div class="inbox-item-img">402</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">SPTNP</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>
      

        <div class="inbox-item">
            <div class="inbox-item-img">403</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Surat Persetujuan Pengeluaran Barang (SPPB) / Persetujuan Keluar</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>



        <div class="inbox-item">
            <div class="inbox-item-img">404</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Surat Persetujuan Pengeluaran Barang (SPPB) / Persetujuan Keluar</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>





        <div class="inbox-item">
            <div class="inbox-item-img">405</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">SPPBMCP Telah Dilunasi, Penerima Barang Silahkan Konfirmasi ke Penyelenggara POS/Perusahaan Jasa Pengirim</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>

        <div class="inbox-item">
            <div class="inbox-item-img">408</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Barang Keluar Dari Gudang</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>




        <div class="inbox-item">
            <div class="inbox-item-img">501</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Penetapan SPPBMCP ( Pembayaran & Persetujuan Keluar ) Menunggu Pemindai X-Ray atau Manifes</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>


        <div class="inbox-item">
            <div class="inbox-item-img">903</div>
            <p class="inbox-item-author">( jumlah data : 0 )</p>
            <p class="inbox-item-text">Data Manifest Tidak Valid</p>
            <p class="inbox-item-date">
            <a href="javascript:(0);" class="btn btn-sm btn-link text-info font-13"> Show </a>
            </p>
        </div>


</div>


<?php


}


?>