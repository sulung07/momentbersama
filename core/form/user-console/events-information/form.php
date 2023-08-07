<?php

class form_events_information extends controller
{


    public function form($data = [])
    {

    $view       = $data[0];
    $clientID   = $data[1];
    $eventID    = $data[2];

    $event      = $this->getData("event")->get(array("by_code" , array($eventID)));
        
    if($view == "manage"):

        $content = $this->getData("event_info")->get(array("by_event" , array($eventID)));
       
    endif;

    $time = $this->datesetting("time");
    $key  = $this->act_key($time);



    ?>


    <div class="col-12">

    <form method="post" id="my-form">

    <input type="hidden" id="action" name="action" value="manage-event-information">
    <input type="hidden" id="contentID" name="contentID" value="<?= $eventID ?>">
    <input type="hidden" id="keyID" name="keyID" value="<?= $time ?>">
    <input type="hidden" id="key" name="key" value="<?= $key ?>">


            <div class="row">

                <div class="col-lg-6">

                <?php if(!empty($content)): ?>
                <?php if($content['groom_pic'] != ""): ?>
                    <div class="form-group text-center bg-light p-2">
                    <img src="<?= $event['event_link'] ?>/assets/media/<?= $content['groom_pic'] ?>" width="100" height="100">
                    </div>
                <?php endif; ?>
                <?php endif; ?>
                <!--  -->

                <div class="form-group">
                    <label class="form-control-label">Groom Name</label>
                    <input type="text" name="groom_name" class="form-control" <?php if(!empty($content)){ ?> value="<?= $content['groom_name'] ?>" <?php } ?> >
                </div>

                <div class="form-group">
                    <label class="form-control-label">Groom Description</label>
                    <textarea class="form-control" name="groom_desc"><?php if(!empty($content)){ ?><?= $content['groom_desc'] ?><?php } ?></textarea>
                </div>

                <div class="form-group">

                <label class="form-control-label">Groom Picture</label>
                <div class="input-group">
                <div class="custom-file">
                <input type="file" name="groomimage" class="custom-file-input" id="groomimage">
                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>

                </div>

                <br>
                <div id="groom-picture" style="width:100%; "></div>


                </div>

                <!--  -->

                </div>
                <div class="col-lg-6">

                <?php if(!empty($content)): ?>
                <?php if($content['bride_pic'] != ""): ?>
                    <div class="form-group text-center bg-light p-2">
                    <img src="<?= $event['event_link'] ?>/assets/media/<?= $content['bride_pic'] ?>" width="100" height="100">
                    </div>
                <?php endif; ?>
                <?php endif; ?>

                <!--  -->
                <div class="form-group">
                    <label class="form-control-label">Bride Name</label>
                    <input type="text" name="bride_name" class="form-control"  <?php if(!empty($content)){ ?> value="<?= $content['bride_name'] ?>" <?php } ?> >
                </div>

                <div class="form-group">
                    <label class="form-control-label">Bride Description</label>
                    <textarea class="form-control" name="bride_desc"><?php if(!empty($content)){ ?><?= $content['bride_desc'] ?><?php } ?></textarea>
                </div>

                <label class="form-control-label">Bride Picture</label>
                <div class="input-group">
                <div class="custom-file">
                <input type="file" name="brideimage" class="custom-file-input" id="brideimage">
                <label class="custom-file-label">Choose file</label>
                </div>

                </div>

                <br>
                <div id="bride-picture" style="width:100%; "></div>

                <!--  -->

                </div>

            </div>

            

            <div class="form-group">
                <label class="form-control-label">Event Date</label>
                <div class="input-group">
                
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>

                    <input type="text" name="event_date"   id="basic-datepicker" class="form-control"  placeholder="Set Date"  <?php if(!empty($content)){ ?> value="<?= $content['event_date'] ?>" <?php } ?> >

                </div>
            </div>

           
            <hr>

            <div class="form-group">

            <button type="submit" name="formSubmit" class="btn btn-success"><i class="fas fa fa-check mr-2"></i>Manage Event Information</button>


            </div>

       
        

    </form>
    </div>


  




<script type="text/javascript">


var resizegroom = $('#groom-picture').croppie({
enableExif: true,
enableOrientation: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square' //square
    },
    boundary: {
        width: '100%',
        height: 250
    },
    // enableResize: true,
    enableResize: false,
    enableZoom: true,
    enforceBoundary: true,
});


var resizebride = $('#bride-picture').croppie({
enableExif: true,
enableOrientation: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square' //square
    },
    boundary: {
        width: '100%',
        height: 250
    },
    // enableResize: true,
    enableResize: false,
    enableZoom: true,
    enforceBoundary: true,
});


$('#groomimage').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
        resizegroom.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('#brideimage').on('change', function () {
  var reader = new FileReader();
    reader.onload = function (e) {
        resizebride.croppie('bind',{
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
});


$('#my-form').on('submit', function(e) {
   e.preventDefault(); // menghentikan form dari pengiriman langsung
   $('#warning-waiting').modal('show');

   var formData = new FormData(this); // membuat objek FormData dari form

   resizegroom.croppie('result', {
     type: 'canvas',
     size: 'viewport',
     quality: 1
   }).then(function (imggroom) {

    if ($('#groomimage').val() == '') {
       formData.append('groomimage', "");
    }else{
       formData.append('groomimage', imggroom);
    }


    resizebride.croppie('result', {
     type: 'canvas',
     size: 'viewport',
     quality: 1
    }).then(function (imagebride) {

        if ($('#brideimage').val() == '') {
        formData.append('brideimage', "");
        }else{
        formData.append('brideimage', imagebride);
        }


        // 

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

        // 


    });


    //  

   });
 });


</script>


    <?php

    }


}
