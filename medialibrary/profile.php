<?php
include_once "includes/header.php";
?>
<script>
    $("body").addClass("layout-fullwidth")
</script>
<div class="container-fluid">
    <h3 class="page-title">My Profile</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel withshadow">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 m-b-30">
                            <input class="form-control" placeholder="Username" type="text">
                        </div>
                        <div class="col-md-6 m-b-30">
                            <input class="form-control" placeholder="First Name" type="text">
                        </div>
                        <div class="col-md-6 m-b-30">
                            <input class="form-control" placeholder="Password" type="password">
                        </div>
                        <div class="col-md-6 m-b-30">
                            <input class="form-control" placeholder="Email" type="email">
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>


