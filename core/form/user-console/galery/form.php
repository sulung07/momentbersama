<?php

class form_events_galery extends controller
{


    public function form($data = [])
    {


        $view          = $data[0];
        $clientID      = $data[1];
        $eventID       = $data[2];
        $galeryID      = $this->hashId("dec" , $data[3]);    
        $eventHash     = $data[4];
    

        if($view == "add"):
    
            $content = "";
            $btn_title="Upload Images";
           
        endif;
    
        if($view == "update")
        {
    
            $btn_title = "Manage Images";
            $content = $this->getData("event_galery")->get(array("by_id" , array($eventID , $galeryID)));
    
    
        }
        $time = $this->datesetting("time");
        $key  = $this->act_key($time);



    ?>


    <div class="col-12">

    <form method="post" id="my-form-galery">

    <input type="hidden" id="action" name="action" value="manage-galery">
    <input type="hidden" id="event" name="event" value="<?= $eventID ?>">
    <input type="hidden" id="contentID" name="contentID" value="<?= $data[3] ?>">
    <input type="hidden" id="keyID" name="keyID" value="<?= $time ?>">
    <input type="hidden" id="key" name="key" value="<?= $key ?>">


            <div class="row">

                <div class="col-lg-12">


                <!--  -->

                <div class="form-group">
                    <label class="form-control-label">Description / Title</label>
                    <textarea class="form-control" name="description"><?php if(!empty($content)){ ?><?= $content['description'] ?><?php } ?></textarea>
                </div>

                <div class="form-group">

                <label class="form-control-label">Images</label>
                <div class="input-group">
                <div class="custom-file">
                <input type="file" class="custom-file-input" id="image">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                </div>
                <br>
                <div id="picture" style="width:100%; "></div>
                </div>

                <!--  -->

                </div>
            </div>
            <hr>
            <div class="form-group">
            <button type="submit" onclick="redirectToOtherPage()" name="formCancel" class="btn btn-danger"><i class="fas fa-arrow-left mr-2"></i>Cancel</button>

            <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i><?= $btn_title ?></button>
            </div>

       
        

    </form>
    </div>


    <div id="warning-waiting" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                  <div class="modal-body p-4">
                      <div class="text-center">
                      <i class="dripicons-primary h1 text-primary"></i>
                      <h4 class="mt-2">Please wait,</h4>
                      <p class="mt-3">we are uploading your data</p>
                      </div>
                 </div>
            </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
    </div>




<script type="text/javascript">



function redirectToOtherPage() {
        // Ganti URL berikut dengan URL halaman tujuan yang Anda inginkan
        var targetUrl = "/events/detail-events/<?=$eventHash?>?tab=galery";
        window.location.href = targetUrl;
}


var resizegalery = $('#picture').croppie({
enableExif: true,
enableOrientation: true,
    viewport: {
        width: 442,
        height: 442,
        type: 'square' //square
    },
    boundary: {
        width: '100%',
        height: 450
    },
    // enableResize: true,
    enableResize: false,
    enableZoom: true,
    enforceBoundary: true,
});




$('#image').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
        resizegalery.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('#my-form-galery').on('submit', function(e) {
   e.preventDefault(); // menghentikan form dari pengiriman langsung

   $('#warning-waiting').modal('show');

   var formData = new FormData(this); // membuat objek FormData dari form

   resizegalery.croppie('result', {
     type: 'canvas',
     size: 'viewport',
     quality: 1
   }).then(function (img) {

    if ($('#image').val() == '') {
       formData.append('image', "");
    }else{
       formData.append('image', img);
    }


        $.ajax({
        url: "/ajax/loadaction.php",
        type: "POST",
        data: formData, 
        processData: false, 
        contentType: false, 
        success: function (data) {
            $("#warning-waiting").modal("hide");
            window.location = ""+data;
        }
        });


   });
 });


</script>


    <?php

    }


}
