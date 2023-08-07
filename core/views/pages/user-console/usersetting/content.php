<?php
$template = new controller_template();
$models_user = $this->getData("dataAccount" , "account");

$url    = $this->site_setting("master_site");
?>


<?php if($view == ""): 

$user_list = $models_user->management($arr = array("get_by_level" , "1"));
$time_exe  = $this->datesetting("time");

$key       = $this->act_key($time_exe);


?>

 
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
                        
            <!-- start page title -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/events">Events List </a></li>
                                <li class="breadcrumb-item active">User List</li>
                            </ol>
                        </div>
                        <h4 class="page-title">User List</h4>
                    </div>
                </div>
            </div>     
            <!-- end page title --> 

         
            <div class="row mb-2">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header bg-white">

                            <button class="btn btn-primary float-right"  data-toggle="modal" data-target="#create-user" ><i class="fas fa fa-plus mr-2"></i>Create new User</button>

                            <!--  -->

                            <div id="create-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="standard-modalLabel">Create New User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">

                                        <form method="post" id="newUser">

                                            <input type="hidden" name="time" value="<?= $time_exe ?>">
                                            <input type="hidden" name="key"  value="<?= $key ?>">

                                            <div class="form-group">
                                                <label for="email">Email / Username</label>
                                                <input type="text" name="email" class="form-control" name="email">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>

                                            <div class="form-group">
                                                <label for="repassword">Re-Password</label>
                                                <input type="password" class="form-control" name="repassword" name="repassword">
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" class="form-control" data-toggle="select2">
                                                    <option value="1">Active</option>
                                                    <option value="2">Non Active</option>
                                                </select>
                                            </div>

                                        </form>
                                                      
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="createUserManagement()">Create New User</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <!--  -->

                        </div>
                        <div class="card-body">

                        <table class="table table-striped" id="basic-datatable">
                        <thead class="table table-striped dt-responsive nowrap w-100 bg-primary text-white">

                            <tr>
                                
                                <th border-0>Email</th>
                                <th border-0>Status</th>
                                <th class="text-right border-0">#</th>
                            </tr>

                        </thead>

                        <tbody>
                            <?php if(!empty($user_list)){ foreach ($user_list as $key => $list) { 

                            $userKey = $this->act_key($list['hashId']);
                            
                            ?>
                                <tr>
                                    <td class="border-0"><?= $list['email'] ?></td>
                                    <td class="border-0"><?php if($list['status'] == "1"){ echo "active"; }else{ echo "non active"; } ?></td>
                                    <td class="border-0">

                                    <div class="dropdown float-right">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                               
                                        <a href="#"  data-toggle="modal" data-target="#update-user-<?= $list['Id'] ?>" class="dropdown-item">Update</a> 
                                      
                                        <!-- <a href="" class="dropdown-item">Archive</a> -->

                                    </div>
                                    </div>


                                    <!--  -->

                                    <div id="update-user-<?= $list['Id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="standard-modalLabel">Create New User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">

                                                <form method="post" id="updateUser_<?= $list['hashId'] ?>">

                                                  
                                                    <input type="hidden" name="key"  value="<?= $userKey ?>">
                                                    <input type="hidden" name="userID" value="<?= $list['hashId'] ?>">

                                                    <div class="form-group">
                                                        <label for="email">Email / Username</label>
                                                        <input type="text" name="email" class="form-control" name="email" value="<?= $list['email'] ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password">
                                                        <i class="text-danger">Kosongkan jika tidak ingin merubah password</i>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="repassword">Re-Password</label>
                                                        <input type="password" class="form-control" name="repassword" name="repassword">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" class="form-control" data-toggle="select2">
                                                            <option value="1" <?php if($list['status'] == 1){ echo "selected"; } ?> >Active</option>
                                                            <option value="2" <?php if($list['status'] == 2){ echo "selected"; } ?> >Non Active</option>
                                                        </select>
                                                    </div>

                                                </form>
                                                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" onclick="updateUser('<?= $list['hashId'] ?>')">Update User</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

                                    <!--  -->

                                    </td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                        </table>

                        </div>
                    </div>

                </div>
                
            </div>

        </div>
    </div>
</div>
<?php endif; ?>


<?php $template->footer(); ?>

<script>

    function updateUser(userID)
    {

        var data = $("#updateUser_"+userID).serialize();

        $.ajax({
            type : "POST",
            url  : "<?= $url ?>/ajax/loadaction.php?action=updatemanagement",
            data : data,
            success :function(response)
            {   
                if(response == "true")
                {
                    window.location.href="<?= $url ?>/usersetting";
                }

            }
        })

    }

    function createUserManagement()
    {   
        var data = $("#newUser").serialize();

        $.ajax({
            type : "post",
            url  : "<?= $url ?>/ajax/loadaction.php?action=createuser",
            data : data,
            success:function(response)
            {

                if(response == "true")
                {
                    window.location.href="<?= $url ?>/usersetting";
                }

            }
        })

    }

</script>