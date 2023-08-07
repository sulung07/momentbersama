<?php

class form_template_slideshow extends controller
{


    public function form($data = [])
    {


        $view          = $data[0];
        $clientID      = $data[1];
        $eventID       = $data[2];
        $slideID      = $this->hashId("dec" , $data[3]);    
        $eventHash     = $data[4];
    

        if($view == "add"):
    
            $content = "";
            $btn_title="Upload Images";
           
        endif;
    
        if($view == "update")
        {
    
            $btn_title = "Manage Images";
            $content = $this->getData("template_slide")->get(array("by_id" , array($eventID , $slideID)));
    
    
        }
        $time = $this->datesetting("time");
        $key  = $this->act_key($time);



    ?>


    <div class="col-12">

    <form method="post" id="my-form-slideshow">

    <input type="hidden" id="action" name="action" value="manage-slideshow">
    <input type="hidden" id="task" name="task" value="<?= $view ?>">
    <input type="hidden" id="event" name="event" value="<?= $eventID ?>">
    <input type="hidden" id="contentID" name="contentID" value="<?= $data[3] ?>">
    <input type="hidden" id="keyID" name="keyID" value="<?= $time ?>">
    <input type="hidden" id="key" name="key" value="<?= $key ?>">


            <div class="row">

                <div class="col-lg-12">
                <!--  -->
                <div class="form-group">
                    <label class="form-control-label">Positions</label>
                    <input type="number" min="1" class="form-control" name="position" <?php if($view == "update"): ?> value="<?= $content['position'] ?>" <?php endif; ?> >
                </div>

                <div class="form-group">
                <label class="form-control-label">Images</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image-slideshow">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                </div>
                <br>
                <div id="picture-slideshow" style="width:100%; "></div>
                </div>
                <!--  -->
                </div>
            </div>
            <hr>
            <div class="form-group">
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

    var resizeslideshow = $('#picture-slideshow').croppie({
    enableExif: true,
    enableOrientation: true,
        viewport: {
            width: 500,
            height: 750,
            type: 'square' //square
        },
        boundary: {
            width: '100%',
            height: 800
        },
        // enableResize: true,
        enableResize: false,
        enableZoom: true,
        enforceBoundary: true,
    });




    $('#image-slideshow').on('change', function () {
    var reader = new FileReader();
        reader.onload = function (e) {
            resizeslideshow.croppie('bind',{
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
        }
        reader.readAsDataURL(this.files[0]);
    });


    $('#my-form-slideshow').on('submit', function(e) {
    e.preventDefault(); // menghentikan form dari pengiriman langsung

    $('#warning-waiting').modal('show');

    var formData = new FormData(this); // membuat objek FormData dari form

    resizeslideshow.croppie('result', {
        type: 'canvas',
        size: 'viewport',
        quality: 1
    }).then(function (img) {

        if ($('#image-slideshow').val() == '') {
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
