<?php class formController extends controller {

public function fg($type){

  if($type == "open"){

    echo "<div class='form-group mt-1'>";

   }
   elseif($type == "close"){

    echo "</div>";

    }

}

public function open_Vueform($method , $id) {

    echo"<form action = ''  id='$id' method='$method' @submit.prevent='validateBeforeSubmit()'>";

}

  public function openform($id , $method ,  $upload) {

    switch ($upload) {
      case 'on':
          echo"<form role='form' id = '$id'  action='' method='$method' enctype='multipart/form-data'>";
        break;


      case 'off':

          echo"<form action = '' id = '$id' method='$method'>";

      break;


    }


  }


  public function closeform(){
      echo"</form>";
  }

  public function form() {

    //require_once('../app/core/form/controller_vueform.php');

     //$vue = new vueController();

     $engine        = $this->engine;
     $name          = $this->name;
     $placeholder   = $this->placeholder;
     $value         = $this->value;
     $id            = $this->id;
     $class         = $this->class;
     $disabled      = $this->disabled;

     switch ($engine) {

          case 'option' :
          ?>

         <option value="<?= $value ?>"><?= $name ?></option>

          <?php
          break;

          case 'textform': ?>
          <input

              type          ="text"
              name          ="<?= $name ?>"
              id            ="<?= $id ?>"
              value         ="<?= $value ?>"
              placeholder   ="<?= $placeholder ?>"
              class         ="<?= $class ?>"

          <?php
              if($disabled == "on"){
                      echo"disabled";
              }elseif($disabled == ""){ }
          ?>


        />

       <?php break;

      //////////////////////////////////////////// Password //////////////////////////////////////////////

          case 'password' : ?>

          <input
          <?php

              if($vue_check == "on"){
                  $getvue = $vue->vueForm( $vue_method , $vue_data );
                  echo $getvue;
              }
          ?>

                type         ="password"
                name         ="<?= $name ?>"
                id           ="<?= $id ?>"
                placeholder  ="<?= $placeholder ?>"
                class        ="<?= $class ?>"
            />

        <?php break;

      //////////////////////////////////////////// Email /////////////////////////////////////////////////

          case 'email' : ?>
          <input

              type         ="email"
              name         ="<?= $name ?>"
              id           ="<?= $id ?>"
              placeholder  ="<?= $placeholder ?>"
              class        ="<?= $class ?>"
              value        = "<?= $value ?>";
           />
        <?php break;

      //////////////////////////////////////////// FILES ///////////////////////////////////////////////////

          case 'files' :

              echo"<br><input type='file' id='$id' name='$name' class='file mt-2' >";

          break;

      //////////////////////////////////////////// TEXTAREA ////////////////////////////////////////////////


          case 'textarea' :
            $ckditor = $this->ckditor;

            if($ckditor == "on"){ $id = "editor2"; }elseif($ckditor == "off"){ $id = ""; }

                    echo "<textarea name='$name' id='$id'  class='form-control'>$value</textarea>";

            if($ckditor == "on"){

            ?>
                    <script>CKEDITOR.replace( 'editor2' );</script>

          <?php
                }elseif($ckditor == "off"){ }
          break;

       /////////////////////////////////////////// TEXTNUMBER /////////////////////////////////////////////////

          case 'textnumber' :

            echo "<input type='number' name='$name' class='form-control' />";

          break;

       /////////////////////////////////////////// RADIO /////////////////////////////////////////////////////

          case 'radio' :

            $status = $this->status;
                if($status == "active"){ $check = "cheked"; }else{ $check = ""; }
                    echo "<input type='radio' name='$name' class='flat'  checked='$check' value='$value' /> $placeholder <br /> ";
          break;

      //  CHECKBOX

          case 'checkbox' :

          $status = $this->status;
                if($status == "active"){ $check = "checked";  }else{ $check = ""; } ?>

                    <input
                    <?php
                    if($vue_check == "on"){
                            $getvue = $vue->vueForm( $vue_method , $vue_data);
                            echo $getvue;
                     }
                     ?>

                    type    ="checkbox"
                    name    ="<?= $name ?>"
                    class   ="checkbox-form"
                    style   ="margin-right:7px;"
                    value   ="<?= $value ?>" <?= $check?> >

          <?php
          break;

          case 'hidden':

          ?>
            <input type="hidden" name="<?= $name ?>" value="<?= $value ?> " id = "<?= $id ?>" >
          <?php

          break;

      //  OPTION

    }

  }


    // LABEL //

  public function label(){

      $label = $this->label;
      //return $this->formview('form/label');
      echo"<label class='form-control-label'>$label</label>";
  }


  public function select_openS(){

    $name       = $this->name;
    $id         = $this->id;
    $search     = $this->search;
    $onchage    = $this->onchange;
    $style      = $this->style;

      ?>

     <select name='<?= $name ?>' <?php if($search == "true"){ ?> onchange="<?= $onchage ?>()" data-live-search='true' <?php } ?>   id='<?= $id ?>' data-style='<?= $style ?>' class='selectpicker col-md-12'  >

    <?php


  }


  public function select_open($name , $type){

    switch ($type) {

        case 'dataSearch' :

            $name       = $this->name;
            $id         = $this->id;
            $onchage    = $this->onchange;


            ?>

                <!-- <select id="<?= $id ?>" name="<?= $name ?>"  class="form-control" <?php if($onchage == ""){ }else{ ?> onchange="<?= createRecipe ?>()" <?php } ?> data-role="select-dropdown" >  -->
                <select id="<?= $id ?>"  data-style="btn-info"  class="selectpicker show-tick form-control" onchange="<?= $onchage ?>()" data-live-search="true">


            <?php

            break;


        case 'onchange':

            $id      = $this->id;
            $onchage = $this->onchange;

        ?>

            <select name="<?= $name ?>" id="<?= $id ?>"  onchange='<?php echo"$onchage"; ?>()' class="form-control" >

        <?php

            break;

        default:

            $id      = $this->id;
            echo"<select name='$name' id='$id' class='form-control'>";
            break;
    }

  }

  public function select_close(){

      echo"</select>";

  }

  public function open_data(){

      $type        = $this->type;
      $name        = $this->name;
      $value       = $this->value;
      $print       = $this->print;
      $modelstype  = $this->modelstype;
      $modelsclass = $this->classmodels;
      $models      = $this->models;
      $modelsfunc  = $this->modelsfunc;
      $modelsloc   = $this->modelsloc;
      $dataparam   = $this->dataparam;


      switch ($type) {

        case 'optionData' :

            $data = $this->getData($classmodels , $modelsloc)->$modelsfunc($modelstype , $dataparam);

            if(!empty($data)){ foreach ($data as $rd ) {
                echo "
                    <option data-tokens='$rd[$print]' value='$rd[$value]>$rd[$print]</option>
                ";
            } }

            break;

        case 'option':

        $data = $this->templatebase($modelsclass , $modelsloc , $models , $modelstype)->$modelsfunc();
        echo"<option data-tokens='SELECT' value='0'>SELECT</option>";

            if(!empty($data)){ foreach ($data as $rd ) {
                echo"<option data-tokens='$rd[$print]'   value='$rd[$value]'  >$rd[$print]</option>";
              }
            }


          break;

          case 'optionpublic':
          $data = $this->publicbase($modelsclass , $modelsloc , $modelstype)->$modelsfunc($dataparam);

           echo"<option data-tokens='SELECT' value='0'>SELECT</option>";

            if(!empty($data)){ foreach ($data as $rd ) { ?>

                <option <?php if($rd[$value] == $this->paramid ){ echo "selected"; } ?> data-tokens="<?= $rd[$print] ?>"   value="<?= $rd[$value] ?>"  ><?= $rd[$print] ?></option>

            <?php
                }
            }


          break;

          case 'checkboxprice':

          $data = $this->publicbase($modelsclass , $modelsloc , $modelstype)->$modelsfunc();

          break;

          case 'checkbox' :

          $paramid = $this->paramid;
          $data = $this->publicbase($modelsclass , $modelsloc , $modelstype)->$modelsfunc($dataparam);

          ?>
              <label><input type="checkbox" id="checkAll"/> Check all</label>
              <?php
                if(!empty($data)){ foreach ($data as $list ) {

                    switch ($modelsfunc) {
                        case 'paymentMethod':
                            $countlist = $this->publicbase('globalsetting' , 'globalsetting' , 'load')->paymentBranch($paramid , $list['id_type'] );

                            break;

                        case 'branchUser' :
                            $countlist = $this->publicbase('globalsetting' , 'globalsetting' , 'load')->priceBranch($paramid , $list['id'] , 'count');
                            $listdata  = $this->publicbase('globalsetting' , 'globalsetting' , 'load')->priceBranch($paramid , $list['id'] , '');
                            break;

                        default:
                            # code...
                            break;
                    }

                    ?>

                           


                    <label class="col-md-12 " style="font-size:14px;">
                        
                    </label>

                    <input type="checkbox" class="" value="<?= $list[$value] ?>" name="<?= $name ?>[]" 

                    <?php
                                if($paramid == ""){ }else{

                                    if($countlist == 1){ echo "checked"; }

                                }
                            ?>
                    
                     > <?= $list[$print] ?>

                    <?php if($modelsfunc == "branchUser"){ ?>
                        <input type="text" value="<?= $listdata['harga'] ?>" placeholder="Price items / Branch" name="price[]" class="form-control ml-1 ">
                    <?php } ?>

              <?php
                } }
              ?>

          <?php

            break;

            case 'checkboxtoogle' :

                break;

          default:
          // code...
          break;
      } ?>

       <script>
            $("#checkAll").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });
        </script>

      <?php


  } // function open_data


  public function default_data($type , $name , $engine){

        switch ($type) {
          case 'radio':

                if($engine == "active_status"){

                    echo "<input type='radio' name='$name' class='flat'  checked='checked' value='1' /> ACTIVE <br />";
                    echo "<input type='radio' name='$name' class='flat'  value='2' /> NON ACTIVE <br />";

                 }

                elseif($engine == "yn"){

                    $value = $this->value;

                ?>

                        <select id = "<?= $name ?>" name="<?= $name ?>" class="form-control">
                            <option value="2" <?php if($value == "2"){ echo "selected"; } ?> style="background:red;">Off</option>
                            <option value="1" <?php if($value == "1"){ echo "selected"; } ?> >On</option>
                        </select>

                <?php
                 }
            break;

          case 'option' :

                 if($engine == "qtyorder"){

                 $set = $this->set;

                    for ($x = 1; $x <= 30; $x++) {

                    ?>
                     <option  value="<?= $x ?>" <?php if($x == $set){ echo"selected"; } ?> ><?= $x ?></option>


                    <?php


                    }

                   }

            break;

          default:
            // code...
            break;
        }



  } // default_data


    //<option data-tokens='Bruschetta (v)'   value='1025953193'  >Bruschetta (v)</option>

 } ?>
