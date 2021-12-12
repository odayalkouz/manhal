<?php
$currentTab = "publishers";
include_once '../includes/breadcrumb.php';
$bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('publishers')."</li>";
include_once "../includes/header.php";
?>
<form   class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-6 float-right">
                        <h5 class="card-title text-left"><?=$prosses->getlang('publishers');?></h5>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover js-exportable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$prosses->getlang('codenumber');?></th>
                            <th><?=$prosses->getlang('publishernamear');?></th>
                            <th><?=$prosses->getlang('publishernameen');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php echo $prosses->GetGroub_PRESTOSOFT();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center d-inline-block m-auto">
            <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                <ul class="pagination">
                    <?php echo $prosses->Pagination(); ?>
                </ul>
            </nav>
        </div>
    </div>
</form>
<?php
include_once "../includes/footer.php";
?>




