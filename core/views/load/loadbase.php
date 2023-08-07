<?php

    class loadcontent extends controller   {


        public function showCategory($getid){

        require_once '../../core/engine/widgetController.php';

          $widget = new widgetController();


          $widget->get_function = "";
          $widget->get_value    = "$getid";
          $widget->get_widget('widget_categoryProduct' , 'maintenacne' , 'categoryProduct');



        }


        public function formshowFrom($getid , $show){

          require_once '../../core/form/buttonController.php';
          require_once '../../core/engine/viewformController.php';



          switch ($show) {
            case '1':

              $count = $this->getData('branch' , 'public/branch')->count_branchUser($getid);

             if($count == 1){

                echo "<option value=''>You dont have any branch</option>";

             }elseif($count > 1){

                $branch = $this->getData('branch' , 'public/branch')->branchUser($getid);

                if(!empty($branch)){ foreach ($branch as $list ) {
                  echo "<option value='$list[id]'>$list[nama]</option>";
                } }

             }



              break;


            case '2' :

              $supplier = $this->getData("dataSupplier" , 'public/supplier')->supplierUser($getid);

              if(!empty($supplier)){ foreach ($supplier as $list ) {
                echo "<option value='$list[id]' >$list[supplier]</option>";
              } }

              break;

            default:
              // code...
              break;
          }

        }


        public function load_stock_content($getid , $show , $action){


            require_once '../../core/form/buttonController.php';
            require_once '../../core/engine/viewformController.php';

            $baseform = new viewformController();
            $btn = new buttonController();

            switch ($action) {
                case 'stock_add':

                        //mariretail
                        if($show == 2){

                            $baseform->get_function="retailBase";
                            $baseform->get_value   ="$getid";
                            $baseform->formcontrol('stockForm' , 'stock' , 'panel');

                        }
                        //

                        if($show == 1){
                            
                            $baseform->get_function="orderBase";
                            $baseform->get_value   ="$getid";
                            $baseform->formcontrol('stockForm' , 'stock' , 'panel');

                        }

                    break;

                case 'stock_branch':
                        
                        // mariretail
                        if($show == 2){
                             $baseform->get_function="retailBranch";
                             $baseform->get_value   ="$getid";
                             $baseform->formcontrol('stockForm' , 'stock' , 'panel');
                        }

                        elseif($show == 1){ 

                            $baseform->get_function="orderBranch";
                            $baseform->get_value   ="$getid";
                            $baseform->formcontrol('stockForm' , 'stock' , 'panel');

                        }
                    break;


                case 'supplier' :

                $supplier = $this->getData("dataSupplier" , 'public/supplier')->supplierUser($getid);

                ?>

                <div class="row">
                <div class="col-12 col-md-12 mt-2">
                  <div class="card">
                      <div class="card-header">
                        <?php
                          $btn->type     = "btn-info";
                          $btn->size     = "btn-sm";
                          $btn->targetid = "supplierform";
                          $btn->icon     = "oi-plus";
                          $btn->print    = "add new supplier";
                          $btn->id       = "";
                          $btn->dataid   = "$getid";
                          $btn->datahref = "";
                          $btn->button_modal();

                         ?>
                      </div>
                      <div class="card-body">


                        <!--  -->
                      <table
                        data-pagination="true"
                        data-search="true"
                        data-toggle="table"
                        data-show-export="false"
                        data-page-size = "5"
                        data-page-list="[5, 25, 50, 100, ALL]"
                        data-card-view="false"
                        class="table-sm" style="font-size:14px;"


                    >

                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Supplier</th>
                                <th>No Tlp</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                if(!empty($supplier)){ $no=0; foreach ($supplier as $listp) { $no++;
                              ?>

                                  <tr>
                                      <td><?= $no ?></td>
                                      <td><?= $listp['supplier'] ?></td>
                                      <td><?= $listp['tlp'] ?></td>
                                      <td><?= $listp['email'] ?></td>
                                      <td>
                                        <?php
                                          $btn->type     = "btn-success";
                                          $btn->size     = "btn-sm";
                                          $btn->targetid = "supplierform$listp[id]";
                                          $btn->icon     = "oi-wrench";
                                          $btn->print    = "";
                                          $btn->id       = "";
                                          $btn->dataid   = "";
                                          $btn->datahref = "";
                                          $btn->button_modal();

                                         ?>

                                         <?php
                                           $btn->type     = "btn-danger";
                                           $btn->size     = "btn-sm";
                                           $btn->targetid = "deletesupplier$listp[id]";
                                           $btn->icon     = "oi-delete";
                                           $btn->print    = "";
                                           $btn->id       = "";
                                           $btn->dataid   = "";
                                           $btn->datahref = "";
                                           $btn->button_modal();

                                          ?>
                                      </td>



                                  </tr>

                            <?php
                                 } }
                            ?>

                        </tbody>

                      <?php
                       ?>
                    </table>

                       <script src="../src/node_modules/bootstrap-table/dist/bootstrap-table.js"></script>
                        <!--  -->

                      </div>
                  </div>
                </div>
              </div>

                <?php

                if(!empty($supplier)){ $no=0; foreach ($supplier as $listp) { $no++;

                      $modal = $this->modal('modal')->formModal($listp['id'] , 'supplier' , 'panel');
                      $modal = $this->modal('modal')->formModal($listp['id'] , 'supplierDel' , 'panel');

                 }}

                $modal = $this->modal('modal')->formModal($getid , 'supplier' , 'panel');

                break;

                case 'allstock' :

                $product = $this->getData('product' , 'public/product')->productUser($getid);





                      ?>

                      <div class="row">
                      <div class="col-12 col-md-12 mt-2">
                        <div class="card">
                            <div class="card-header">Data Stock Product</div>
                            <div class="card-body">


                              <!--  -->
                            <table
                              data-pagination="true"
                              data-search="true"
                              data-toggle="table"
                              data-show-export="false"
                              data-page-size = "5"
                              data-page-list="[5, 25, 50, 100, ALL]"
                              data-card-view="false"
                              class="table-sm" style="font-size:14px;"


                          >

                          <?php

                            if($show == 2){

                            ?>

                              <thead class="thead-dark">
                                  <tr>
                                      <th>No</th>
                                      <th>Product</th>
                                      <th>Curr Stock</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>

                              <tbody>

                                  <?php
                                      if(!empty($product)){ $no=0; foreach ($product as $listp) { $no++;

                                        // get stock

                                        $stock = $this->getData('stock_data' , 'public/stock')->countallStock($listp['id'] , $show);
                                    ?>

                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $listp[nama] ?></td>
                                            <td>
                                              <?= $stock[curr_stock] ?>
                                            </td>
                                            <td>
                                              <?php

                                                $btn->type     = "btn-info";
                                                $btn->size     = "btn-sm";
                                                $btn->targetid = "historystock$listp[id]";
                                                $btn->icon     = "oi-eye";
                                                $btn->print    = "historystock$listp[id]";
                                                $btn->id       = "";
                                                $btn->dataid   = "";
                                                $btn->datahref = "";
                                                $btn->button_modal();




                                               ?>
                                            </td>



                                        </tr>

                                  <?php


                                       } }
                                  ?>

                              </tbody>

                            <?php } // if base == 2
                             ?>
                          </table>



                             <script src="../src/node_modules/bootstrap-table/dist/bootstrap-table.js"></script>
                              <!--  -->

                            </div>
                        </div>
                      </div>
                    </div>



                  <?php

                  if($show == 2){

                  $products = $this->getData('product' , 'public/product')->productUser($getid);



                  if(!empty($products)){ foreach ($products as $listps) {


                     $modal = $this->modal('modal')->panelviewModal($listps['id'] , 'stockhistoryRetail' , '');


                   }}

                  }


                  break;


                default:

                    break;
            }

         }

        public function load_buttonOrder($getid){

            require_once '../../core/form/buttonController.php';
            $btn = new buttonController();

            $btn->engine    = "btn-danger";
            $btn->size      = "btn-block";
            $btn->text      = "PESAN";
            $btn->id        = "product$product[idProduct]";
            $btn->vue       = "off";

            $btn->button_default();


         }

        public function load_orderDetail($getid , $show){

            require_once '../../core/form/formController.php';
            require_once '../../core/form/buttonController.php';

            $form = new formController();
            $btn  = new buttonController();

            $orderheader = $this->getData('orderData' , 'public/order')->getorder('getbyid' , $getid);
            $branch  = $this->getData('branch' , 'public/branch')->getBranch($orderheader['id_branch']);
            
            // models data all
            $data = $this->load_templatebase('data' , 'mariorder' , 'order' )->listOrder('load' , $getid , 'show');
            // models data single
            $datas   = $this->load_templatebase('data' , 'mariorder' , 'order' )->orderDetail('load' , $getid  , 'show');

            ?>

            <?php

            switch ($show) {

                case 'modalshow1' : ?>

                    <table class="table" style="font-size:14px;">

                        <tr>
                            <td>No Order / Waktu Pesan</td>
                            <td>:</td>
                            <td><strong>#<?= $datas['no_order'] ?> </strong> / <?= $datas['waktu_pesan'] ?></td>
                        </tr>

                        <tr>
                            <td>Nama Pelanggan / Meja</td>
                            <td>:</td>
                            <td><?= $datas['nama_pelanggan'] ?> / <?= $datas['meja'] ?></td>
                        </tr>

                    </table>


                            <div class="row">

                                <div class="col-12 col-md-6">

                                    <h5 class="m-2"><span class="oi oi-list mr-2"></span>List Order</h5>

                                    <table class="table" style="font-size:14px;">

                                        <thead class="thead-dark">
                                                <tr>
                                                    <td>No</td>
                                                    <td>Items</td>
                                                    <td>Qty</td>
                                                </tr>

                                        </thead>

                                        <tbody>
                                            <?php
                                                if(!empty($data)){ $no = 0; foreach ($data as $list ) { $no ++;
                                                    # code...
                                                    echo "
                                                        <tr>
                                                            <td>$no</td>
                                                            <td>$list[nama]</td>
                                                            <td>$list[qty]</td>
                                                        </tr>
                                                    ";

                                                } }
                                            ?>
                                        </tbody>



                                    </table>

                                </div>

                                <div class="col-12 col-md-6">

                                    <h5 class="m-2"><span class="oi oi-tags mr-2"></span>Payment</h5>

                                </div>

                            </div>




                <?php
                    break;

                case 'titleList' :

                    echo " <h5 class='p-1 cw'> <a href='../../order/$datas[id]'><span class='oi oi-chevron-left mr-2 text-white'></span></a> no order : #$datas[no_order] </h5>";

                 break;

                case 'itemList':
                ?>

                <div class="row">
                    <div class="col-12">

                    <!--  -->
                    <table class="table" style=" font-size:13px;">

                        <thead class="bg-light">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if(!empty($data)){ $no = 0; foreach ($data as $order) { 
                                $no++;
                                $countmoney = $order['harga'] * $order['qty'];
                                $count_total += $countmoney;
                                // format money
                                $money = $this->vendor('moneyFormat' , 'vendor' , 'moneyFormat' ,'load')->index('IDR' ,$order['harga']);
                                $sumMoney = $this->vendor('moneyFormat' , 'vendor' ,'moneyFormat' , 'load')->index('IDR' , $countmoney );
                            ?>

                            <tr>
                                <td>
                                    <?php
                                        $strname = substr($order['nama'], 0 , 15);
                                    ?>
                                    <?= $strname ?>..<br>
                                    <span class="cg"><?= $money ?></span>
                                </td>
                               
                                <td>
                                <?= $order['qty'] ?>

                                </td>
                                <td><?= $sumMoney ?></td>
                            </tr>

                         

                            <?php }} ?>

                            <?php 

                             

                              $sum_tax  = $branch['tax'] + $branch['service'];
                              $get_tax  = $sum_tax / 100;
                              $tax      = $get_tax * $count_total;
                              
                              $total_payment = $tax + $total;

                              $format_count_total = $this->vendor('moneyFormat' , 'vendor' ,'moneyFormat' , 'load')->index('IDR' , $count_total );
                              $format_tax = $this->vendor('moneyFormat' , 'vendor' ,'moneyFormat' , 'load')->index('IDR' , $tax );
                            ?>

                            <tr>
                              <td colspan="2" >TOTAL</td>
                              <td class="bg-secondary text-white" ><?= $format_count_total ?></td>
                            </tr>

                            <tr>
                              <td colspan="2" >Tax & Service</td>
                              <td class="text-warning"><?= $format_tax ?></td>
                            </tr>


                        </tbody>
                    </table>
                    <!--  -->
                    
                    </div>
                </div>

                    


                <?php
                    break;

                case 'aiPrice' :

                    $harga = $_GET['harga'];

                    if($harga == ""){

                        if(!empty($data)){ $no = 0; foreach ($data as $order) { $no++;

                            $harga += $order['harga'] * $order['qty'];;

                        }}

                    }


                        $price  = substr($harga , 0,1);
                        $prices = substr($harga , 1,1);

                        $pricex = substr($harga , 2,1);


                        if($harga <= 100000){

                        switch ($price) {

                            case '1':
                                $aiPrice = "20000";
                                break;

                            case '2':
                                $aiPrice = "30000";
                                break;

                            case '3':
                                $aiPrice = "40000";
                                break;

                            case '4':
                                $aiPrice = "50000";
                                break;

                            case '5':
                                $aiPrice = "60000";
                                break;

                            case '6':
                                $aiPrice = "70000";
                                break;

                            case '7':
                                $aiPrice = "80000";
                                break;

                            case '8':
                                $aiPrice = "90000";
                                break;

                            default:
                                # code...
                                break;

                        }

                        }elseif($harga > 100000){

                            switch ($prices) {

                                case '0':
                                    $getp    = "10000";
                                    $aiPrice = "$price$getp";
                                break;

                                case '1':
                                    $getp    = "20000";
                                    $aiPrice = "$price$getp";
                                break;

                                case '2':
                                    $getp    = "30000";
                                    $aiPrice = "$price$getp";
                                    break;

                                case '3':
                                    $getp    = "40000";
                                    $aiPrice = "$price$getp";
                                    break;

                                case '4':
                                    $getp    = "50000";
                                    $aiPrice = "$price$getp";
                                    break;

                                case '5':
                                    $getp    = "60000";
                                    $aiPrice = "$price$getp";
                                    break;

                                case '6':
                                    $getp    = "70000";
                                    $aiPrice = "$price$getp";
                                    break;

                                case '7':
                                    $getp    = "80000";
                                    $aiPrice = "$price$getp";
                                    break;

                                case '8':
                                    $getp    = "90000";
                                    $aiPrice = "$price$getp";
                                    break;

                            }
                        }

                    ?>

                    <div class="row" style="font-size:13px;">
                        <span class="btn btn-default keys m-2" id="key">
                              <?= $harga ?>
                        </span>

                            <?php
                                if($harga < 100000){
                            ?>

                            <?php
                                if($prices <= 4 and $prices != 0){ ?>

                                <span class="btn btn-default keys m-2" id="key"><?= $price ?>5000 </span>

                            <?php }}else{

                                if($pricex <= 4 and $pricex != 0){

                                ?>
                                <span class="btn btn-default keys m-2" id="key"><span class="oi oi-check mr-2"></span><?= $price ?>50000 </span>

                            <?php } } ?>


                            <?php
                            if($price != 9 ){ ?>
                                <span class="btn btn-default keys m-2" id="key"><?= $aiPrice ?></span>
                            <?php } ?>



                            <?php
                                if($harga < 50000 or $harga <= 50000 ){
                                    if($price != 4 ){
                            ?>
                                    <span class="btn btn-default keys m-2" id="key">50000</span>

                            <?php  } }
                                elseif($harga > 100000){
                                    //if($harga < 150000)
                                    if($pricex != 4){ ?>

                                    <span class="btn btn-default keys m-2" id="key"><?= $price ?>50000</span>
                            <?php
                                    }
                                }
                            ?>

                            <?php
                                if($harga < 100000){ ?>

                                <span class="btn btn-default keys m-2" id="key"> 100000</span>

                            <?php }

                                elseif($harga < 200000){
                            ?>
                                <span class="btn btn-default keys m-2" id="key">200000</span>

                            <?php }
                                elseif($harga < 300000){
                            ?>
                                <span class="btn btn-default keys m-2" id="key">300000</span>

                            <?php }
                                elseif($harga < 400000){
                            ?>
                                <span class="btn btn-default keys m-2" id="key">400000</span>
                            <?php } ?>

                    </div>

                    <script type="text/javascript">

                        $(document).ready(function(){

                        $('.keys').click(function(){
                        var terbayar = document.getElementById('terbayar');
                        var terbayarh = document.getElementById('terbayarh');
                            if(this.innerHTML == '0'){

                                if (terbayar.innerHTML.length > 0) {
                                    terbayar.innerHTML = parseDelimiter(terbayar.innerHTML + this.innerHTML);
                                    terbayarh.innerHTML = terbayarh.innerHTML + this.innerHTML;

                                    }

                            }
                            else{
                                    terbayar.innerHTML = parseDelimiter(terbayar.innerHTML + this.innerHTML);
                                    terbayarh.innerHTML = terbayarh.innerHTML + this.innerHTML;

                                }

                        event.stopPropagation();
                        });

                        function parseDelimiter(val){
                            var n = parseInt(val.replace(/\D/g,''),10);
                            return n.toLocaleString();
                         }

                        });
                    </script>

                    <?php

                    break;


                case 'listCashier' : ?>

                        <link rel="stylesheet" href="../mariretail/src/node_modules/bootstrap-table/dist/bootstrap-table.css" type="text/css">
                        <table
                            data-pagination="true"
                            data-search="false"
                            data-toggle="table"
                            data-show-export="false"
                            data-page-size = "5"
                            data-page-list="[5, 25, 50, 100, ALL]"
                            data-card-view="false"
                            class="table-sm"


                        >
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>QTY</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody >

                                <?php


                                    if(!empty($data)){ $no = 0; foreach ($data as $order) { $no++;
                                    $getcostqty   = $order['qty'] * $order['harga'];
                                    // format money
                                    $countCostqty = $this->vendor('moneyFormat' , 'vendor' , 'moneyFormat' ,'load')->index('IDR' ,$getcostqty);

                                 ?>

                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $order[nama] ?></td>
                                    <td><?= $order[qty] ?></td>
                                    <td>Rp. <?= $countCostqty ?></td>

                                </tr>

                                <?php } } ?>

                            </tbody>
                        </table>
                        <script src="../mariretail/src/node_modules/bootstrap-table/dist/bootstrap-table.js"></script>
                    <?php
                        break;

                default:
                    # code...
                    break;
            }

        ?>

            <?php

        }

    public function kitchenprint($getid , $show){

        switch ($show) {
            case 'getidforprint':
                $printid = $this->getData('kitchendata' , 'public/kitchen')->idforprint($getid);
                echo"$printid[id]";
                break;

            case 'contentprint' :
               
                $order = $this->getData('kitchendata' , 'public/kitchen')->listorder('getorder' , 'order' , $getid);
                $getlist = $this->getData('kitchendata' , 'public/kitchen')->listorder('printorder' , 'detail' , $getid);

                $str .= "No Orders : $order[no_order]|R|";
                $str .= "$order[waktu_pesan]|R|";
               
    
    
                echo $str;
                echo"================================|R|";
                echo"Order Detail : |R||R|";

                if(!empty($getlist)){ foreach ($getlist as $list ) {
                    
                    $strt = "$list[nama] x $list[qty] |R|";
                    
        
                    echo $strt;
        
        
                    echo"================================|R|";


                } }
    
                

                break;
            
            default:
                # code...
                break;
        }


    }

    public function billprintcontent($getid , $show , $branch){

        // get order 
        $order = $this->getData('orderData' , 'public/order')->getorder('getbyid' , $getid);
        // get detail 
        $get_detail = $this->getData('orderData' , 'public/order')->orderdetail('getall' , $order['id']);
        // get branch
        $branch = $this->getData('branch' , 'public/branch')->getBranch($branch);

        echo "$branch[nama]|R||R|";

        echo "================================|R|";

        $str .= "No Order : $order[no_order]|R|";
        $str .= "$order[waktu_pesan]|R|";

        echo $str;
        echo"================================|R|";
        echo"Order Detail : |R||R|";

        if(!empty($get_detail)){ foreach ($get_detail as $detail) {

        // 

        $item += $detail['qty'];
        $total = $detail['harga'] * $detail['qty'];

        $gettotal += $total;

        $format_harga =number_format($total,0,',','.');

        $menu_sumbs = substr("$detail[nama]", 0,31);

        $strt = "$menu_sumbs |R|";
        $strt .= "x $detail[qty] @ $detail[harga]     = IDR.$format_harga  |R|";
        

        echo $strt;
        //  
        } }


        echo"================================|R|";

        if($branch['tax'] == 0 and $branch['service'] == 0){ }else{ 

            $taxs = $branch['tax'] + $branch['service'];
            
            $get_percent = $taxs / 100;
            $get_total_bill = $get_percent * $gettotal;
            $format_tax = number_format($get_total_bill,0,',','.');

        }

        $bill = $gettotal + $get_total_bill;
        $format_bill = number_format($bill,0,',','.');

        $format_total =number_format($gettotal,0,',','.');

        echo "Tax & service : IDR $format_tax  |R|" ;
        
        $print_str = "TOTAL TAGIHAN : IDR $format_bill |R| ";



        echo $print_str;

        echo"|R|";


    }


    public function strokeprintcontent($getid , $show){

    $action  = $_GET['actionprint'];
    $user    = $_GET['user'];


    $data = $this->publicbase('cashierData' , 'cashier' ,'load')->cashierPrint($show , 'load');


    switch ($action) {
      case 'strokeCashier':

        

          $datas   = $this->templatebase('data' , 'mariorder' , 'order' , 'load')->getOrder( $data['id_order'], $getid);
          $branch = $this->getData('branch' , 'public/branch')->getBranch($getid);
          $getuser = $this->getData('userInfo' , 'public/user')->getUser('cashier' , $user , $getid);

       
         

            //
                $taxs = $branch['tax'] + $branch['service'];  
                $get_percent = $taxs / 100;
            
            //


            echo "$branch[nama]|R||R|";

            echo "================================|R|";

            $str .= "No Order : $datas[no_order]|R|";
            $str .= "$datas[waktu_pesan]|R|";
            $str .= "Cashier : $getuser[username] |R|";


            echo $str;
            echo"================================|R|";
            echo"Order Detail : |R||R|";

            $detail = $this->templatebase('data' , 'mariorder' , 'order' , 'load')->orderPrint($datas['id'] , 'listorder');



            if(!empty($detail)){ $count = 0;

            foreach($detail as $rd_detail){

            $item += $rd_detail['qty'];
            $total = $rd_detail['harga'] * $rd_detail['qty'];

            $get_total  += $total;

            $format_harga =number_format($total,0,',','.');

            $menu_sumbs = substr("$rd_detail[nama]", 0,31);

            $strt = "$menu_sumbs |R|";
            $strt .= "x $rd_detail[qty] @ $rd_detail[harga]     = IDR.$format_harga  |R|";

            echo $strt;

            }

            $get_total_bill = $get_percent * $get_total;
            $format_tax = number_format($get_total_bill,0,',','.');

            

            echo"================================|R|";

            if($branch['tax'] == 0 and $branch['service'] == 0){ }else{ 
            echo "Tax & Service  = IDR $format_tax |R|";
            }

            }else{}

            $printdetail = $this->publicbase('cashierData' , 'cashier' ,'load')->cashierPrint($show , 'load');

            echo"Pembayaran : |R||R|";


            $format_tagihan =number_format($printdetail['tagihan'],0,',','.');
            $format_terbayar =number_format($printdetail['terbayar'],0,',','.');
            $format_kembali =number_format($printdetail['kembali'],0,',','.');

            $strc  = "Total Tagihan    = IDR.$format_tagihan |R|";
            $strc .= "Terbayar         = IDR.$format_terbayar |R|";
            $strc .= "Kembalian        = IDR.$format_kembali |R|";
            

            echo $strc;

            echo "================================|R|";
            echo "$branch[footer_print]";

            echo"|R||R|";

            //


            echo "$branch[nama]|R||R|";

            echo "================================|R|";

            $str2 .= "No Order : $datas[no_order]|R|";
            $str2 .= "$datas[waktu_pesan]|R|";
            $str2 .= "Cashier : $getuser[username] |R|";


            echo $str2;
            echo"================================|R|";
            echo"Order Detail : |R||R|";

            $detail = $this->templatebase('data' , 'mariorder' , 'order' , 'load')->orderPrint($datas['id'] , 'listorder');



            if(!empty($detail)){ $count = 0;

            foreach($detail as $rd_detail){

            $item += $rd_detail['qty'];
            $total = $rd_detail['harga'] * $rd_detail['qty'];

            $get_total  += $total;

            $format_harga =number_format($total,0,',','.');

            $menu_sumbs = substr("$rd_detail[nama]", 0,31);

            $strt  = "$menu_sumbs |R|";
            $strt .= "x $rd_detail[qty] @ $rd_detail[harga]     = IDR.$format_harga  |R|";

            echo $strt;

            }
            
            echo"================================|R|";

            if($branch['tax'] == 0 and $branch['service'] == 0){ }else{ 
            echo "Tax & Service  = IDR $format_tax |R|";
            }

            }else{}

            $printdetail = $this->publicbase('cashierData' , 'cashier' ,'load')->cashierPrint($show , 'load');

            echo"Pembayaran : |R||R|";


            $format_tagihan =number_format($printdetail['tagihan'],0,',','.');
            $format_terbayar =number_format($printdetail['terbayar'],0,',','.');
            $format_kembali =number_format($printdetail['kembali'],0,',','.');

            $strc  = "Total Tagihan    = IDR.$format_tagihan |R|";
            $strc .= "Terbayar         = IDR.$format_terbayar |R|";
            $strc .= "Kembalian        = IDR.$format_kembali |R|";

            echo $strc;

            echo "================================|R|";
            echo "$branch[footer_print]";

            echo"|R||R|";



            //

        // code...
        break;

      default:
        // code...
        break;
    }

    }

    public function load_cashiermanager($getid , $show){

        $data = $this->publicbase('cashierData' , 'cashier' ,'load')->cashier($getid , 'load');

        switch ($show) {

            case 'contentprint':
            $datas   = $this->templatebase('data' , 'mariorder' , 'order' , 'load')->orderPrint($getid , 'order');

                //

                $str = "Nama Pelanggan : $datas[nama_pelanggan]|R|";
                $str .= "$datas[waktu_pesan]|R|";

                echo $str;
                echo"================================|R|";
                echo"Order Detail : |R||R|";

                $detail = $this->templatebase('data' , 'mariorder' , 'order' , 'load')->orderPrint($datas['id'] , 'listorder');



                if(!empty($detail)){ $count = 0;

                foreach($detail as $rd_detail){

                $item += $rd_detail['qty'];
                $total = $rd_detail['harga'] * $rd_detail['qty'];

                $format_harga =number_format($total,0,',','.');

                $menu_sumbs = substr("$rd_detail[nama]", 0,31);

                $strt = "$menu_sumbs |R|";
                $strt .= "x $rd_detail[qty] @ $rd_detail[harga]     = IDR.$format_harga  |R|";

                echo $strt;

                }

                echo"================================|R|";

                }else{}

                $printdetail   = $this->templatebase('data' , 'mariorder' , 'order' , 'load')->orderPrint($getid , 'getdataPrint');

                echo"Pembayaran : |R||R|";


                $format_tagihan =number_format($printdetail['tagihan'],0,',','.');
                $format_terbayar =number_format($printdetail['terbayar'],0,',','.');
                $format_kembali =number_format($printdetail['kembali'],0,',','.');

                $strc  = "Total Tagihan    = IDR.$format_tagihan |R|";
                $strc .= "Terbayar         = IDR.$format_terbayar |R|";
                $strc .= "Kembalian        = IDR.$format_kembali |R|";

                echo $strc;

                echo"|R||R|";



                //

                break;

            case 'getidforprint':
                $printid = $this->publicbase('cashierData' , 'cashier' ,'load')->idforprint($getid , 'load');
                echo"$printid[id_cashier]";
                break;

            case 'terbayar':

                $terbayar = $this->vendor('moneyFormat' , 'vendor' , 'moneyFormat' ,'load')->index('IDR' ,$data['terbayar']);
                echo "$terbayar";
                break;

            case 'kembali':

                $kembali = $this->vendor('moneyFormat' , 'vendor' , 'moneyFormat' ,'load')->index('IDR' ,$data['kembali']);
                echo "$kembali";
                break;

            default:
                # code...
                break;
        }


    }

    public function load_countprice($getid , $show){

        require_once '../../core/form/buttonController.php';
        $btn  = new buttonController();

            // header

            $orderheader = $this->getData('orderData' , 'public/order')->getorder('getbyid' , $getid);

            //$countorder   = $this->load_templatebase('data' , 'mariorder' , 'order')->listOrder('load' , $getid , 'countItem');
            $data    = $this->load_templatebase('data' , 'mariorder' , 'order')->listOrder('load' , $getid , 'show');
            $datas   = $this->load_templatebase('data' , 'mariorder' , 'order' )->orderDetail('load' , $getid  , 'show');
            $branch  = $this->getData('branch' , 'public/branch')->getBranch($orderheader['id_branch']);
          
            if(!empty($data)){ foreach ($data as $order) {

                $total += $order['harga'] * $order['qty'];


            } }

            $sum_tax  = $branch['tax'] + $branch['service'];
            $get_tax  = $sum_tax / 100;
            $tax      = $get_tax * $total;
            
            $total_payment = $tax + $total;

            $money = $this->vendor('moneyFormat' , 'vendor' , 'moneyFormat' ,'load')->index('IDR' ,$total_payment);

            switch ($show) {

                case 'orderPrice':
                    # code...
                    echo "$money";
                    break;

                case 'mobile' :

                ?>
                    
                    <a href="../../checkout/<?= $getid ?>"><center><h4 class="cg text-white pt-2">IDR <strong><?= $money ?></strong></h4></center></a>

                <?php



                    break;

                default:

                if($datas['status'] == 3){ ?>

                   <div class="col-12 col-md-12 bg_c1"><h5 class="p-3"><span class="oi oi-check mr-2"></span>Rp. <?= $money ?></h5></div>

                <?php
                }else{

                ?>
                    <div class="row">
                        <div class="col-12 col-md-12">
                            
                            <center><h4 class="text-secondary p-2">IDR <strong><?= $money ?>  </strong></h4></center>

                        </div>
                        <div class="col-12 col-md-12 m-0 p-0">

                            <div class="row m-0 p-0">

                                <div class="col-12">

                                    <button class="btn btn-block btn-success btn-raised rounded" id="finish"><span class="oi oi-print"></span></button>

                                </div>
                                <div class="col-12">

                                    <?php
                                        $btn->type     = "btn-warning rounded btn-raised";
                                        $btn->size     = " btn-block";
                                        $btn->targetid = "cashierContent";
                                        $btn->icon     = "";
                                        $btn->print    = "Payment";
                                        $btn->id       = "loadcashier";
                                        $btn->button_modal();
                                    ?>

                                </div>

                                <script type="text/javascript">
                                    $(document).ready(function(){

                                        $("#finish").click(function(){

                                            
                                        $.ajax({

                                            method: 'GET',
                                            url : "../loadController/loadaction.php?action=updatestatusorder&id=<?= $getid ?>",

                                            success: function() {

                                            window.location = '../../';
                                                

                                            }

                                        })
                                        
                                    });

                                    $("#loadcashier").click(function(){

                                    $.ajax({
                                    method: 'GET',
                                    url : "../loadController/loadaction.php",

                                    success: function() {

                                        $('#grandtotal').load("../loadController/loadcontrol.php?action=loadpriceCashier&data=<?= $getid ?>&show=orderPrice");
                                        $('#aiPrice').load("../loadController/loadcontrol.php?action=orderDetail&data=<?= $getid ?>&harga=<?= $total ?>&show=aiPrice");

                                    }

                                    });
                                    });
                                    });
                                </script>

                                <div class="netral"></div>


                            </div>

                        </div>
                    </div>

                    <?php

                    }
                    break;
            }

            ?>




        <?php

        }

    }


?>
