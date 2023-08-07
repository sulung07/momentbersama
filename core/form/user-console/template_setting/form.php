<?php

class form_template_setting extends controller
{


    public function form($data = [])
    {

        $formaction = $this->getAction( 'actionEvents' , 'user-console/events');


        $view          = $data[0];
        $clientID      = $data[1];
        $eventID       = $data[2];
        $eventHash     = $data[3];

        if($view == "manage")
        {
    
            $btn_title = "Manage Images";

            $content = $this->getData("template_setting")->get(array("get_single" , array($eventID)));

    
        }


        $time = $this->datesetting("time");
        $key  = $this->act_key($time);

        if(isset($_POST['formSubmitTemplate']))
        {

            $formaction->actioncontrol_templatesetting($arr = array("$view" , "$time" , "$key" , $eventID) , $content);

        }
       


    ?>


    <div class="col-12">

    <form method="post" enctype="multipart/form-data">


            <div class="row">

                <div class="col-lg-12">

                <!--  -->

                <div class="form-group">
                    <label class="form-control-label">Header Section Title</label>
                    <input type="text" name="header_section_title" class="form-control" <?php if(!empty($content)): ?> value="<?= $content['header_section_title'] ?>" <?php endif; ?> >
                </div>

                <div class="form-group">
                    <label class="form-control-label">Header Serction Title Small</label>
                    <input type="text" name="header_section_title_small" class="form-control" <?php if(!empty($content)): ?> value="<?= $content['header_section_title_small'] ?>" <?php endif; ?> >
                </div>

                <div class="form-group">
                    <label class="form-control-label">Splash Title</label>
                    <input type="text" name="splash_title" class="form-control" <?php if(!empty($content)): ?> value="<?= $content['splash_title'] ?>" <?php endif; ?>>
                </div>

                <div class="form-group">
                    <label class="form-control-label">Splash Title Small</label>
                    <input type="text" name="splash_title_small" class="form-control" <?php if(!empty($content)): ?> value="<?= $content['splash_title_small'] ?>" <?php endif; ?> >
                </div>

                <div class="form-group">
                    <label class="form-control-abel">Video Link</label>
                    <input type="text" name="video_link" class="form-control" <?php if(!empty($content)): ?> value="<?= $content['video_link'] ?>" <?php endif; ?> > 
                </div>

                <div class="form-group">
                    <label class="form-control-abel">Audio Link</label>
                    <input type="text" name="music_file" class="form-control" <?php if(!empty($content)): ?> value="<?= $content['music_file'] ?>" <?php endif; ?> >
                </div>


                <div class="form-group">

                    <label class="form-control-label">Background Section 1</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="background_section_1">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                    </div>
                    
                </div>

                <div class="form-group">

                    <label class="form-control-label">Background Section 2</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="background_section_2">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                    </div>
                    
                </div>


                <div class="form-group">

                    <label class="form-control-label">Background Section 3</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="background_section_3">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                        </div>
                    </div>
                    
                </div>

                <!--  -->

                </div>
            </div>
            <hr>
            <div class="form-group">
            <button type="submit" name="formSubmitTemplate" class="btn btn-success"><i class="fas fa fa-check mr-2"></i>Manage Template</button>
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



// function redirectToOtherPage() {
//         // Ganti URL berikut dengan URL halaman tujuan yang Anda inginkan
//         var targetUrl = "/events/detail-events/<?=$eventHash?>?tab=galery";
//         window.location.href = targetUrl;
// }


// var resizegalery = $('#picture').croppie({
// enableExif: true,
// enableOrientation: true,
//     viewport: {
//         width: 1000,
//         height: 442,
//         type: 'square' //square
//     },
//     boundary: {
//         width: '100%',
//         height: 450
//     },
//     // enableResize: true,
//     enableResize: false,
//     enableZoom: true,
//     enforceBoundary: true,
// });




// $('#image').on('change', function () {
//   var reader = new FileReader();
//     reader.onload = function (e) {
//         resizegalery.croppie('bind',{
//         url: e.target.result
//       }).then(function(){
//         console.log('jQuery bind complete');
//       });
//     }
//     reader.readAsDataURL(this.files[0]);
// });


// $('#my-form-galery').on('submit', function(e) {
//    e.preventDefault(); // menghentikan form dari pengiriman langsung

//    $('#warning-waiting').modal('show');

//    var formData = new FormData(this); // membuat objek FormData dari form

//    resizegalery.croppie('result', {
//      type: 'canvas',
//      size: 'viewport',
//      quality: 1
//    }).then(function (img) {

//     if ($('#image').val() == '') {
//        formData.append('image', "");
//     }else{
//        formData.append('image', img);
//     }


//         $.ajax({
//         url: "/ajax/loadaction.php",
//         type: "POST",
//         data: formData, 
//         processData: false, 
//         contentType: false, 
//         success: function (data) {
//             $("#warning-waiting").modal("hide");
//             window.location = ""+data;
//         }
//         });


//    });
//  });


</script>


    <?php

    }


}
