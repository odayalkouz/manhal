<?php
include_once "includes/header.php";
?>
    <link rel="stylesheet" href="<?=$prosses->URL;?>medialibrary/themes/en/css/admin.css">
    <script>
        $("body").addClass("layout-fullwidth")
    </script>
    <div class="panel panel-headline">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12"><h3 class="page-title m-t-10 m-b-20"><?=$prosses->lang('Type');?></h3></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <a href="edittype.php" class="btn-sm shadow-none btn-primary pull-right"><?=$prosses->lang('add');?></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$prosses->lang('name');?></th>
                            <th><?=$prosses->lang('Directory');?></th>
                            <th><?=$prosses->lang('Extention');?></th>
                            <th><?=$prosses->lang('Action');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td class="actions-container">
                                <a class="edit" href="edittype.php" title="<?=$prosses->lang('edit');?>"><i class="lnr lnr-pencil"></i></a>
                                <a class="delete"><i class="lnr lnr-trash" title="<?=$prosses->lang('delete');?>"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center d-inline-block m-auto">
                        <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                            <ul class="pagination">
                                <li class="page-item active"><a href="javascript:GotoPage(0,198,0);" class="page-link">1</a></li><li class="page-item "><a href="javascript:GotoPage(1,198,0);" class="page-link">2</a></li><li class="page-item "><a href="javascript:GotoPage(2,198,0);" class="page-link">3</a></li><li class="page-item "><a href="javascript:GotoPage(3,198,0);" class="page-link">4</a></li><li class="page-item "><a href="javascript:GotoPage(4,198,0);" class="page-link">5</a></li><li class="page-item "><a href="javascript:GotoPage(5,198,0);" class="page-link">6</a></li><li class="page-item "><a href="javascript:GotoPage(6,198,0);" class="page-link">7</a></li><li class="page-item "><a href="javascript:GotoPage(7,198,0);" class="page-link">8</a></li><li class="page-item "><a href="javascript:GotoPage(8,198,0);" class="page-link">9</a></li><li class="page-item "><a href="javascript:GotoPage(9,198,0);" class="page-link">10</a></li><li class="page-item"><a href="javascript:GotoPage(10,198,10);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>                        </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once "includes/footer.php";
?>