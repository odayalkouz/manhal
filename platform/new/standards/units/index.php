<?php
$currentTab = "Units";

include_once "../../includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-10 float-right m-b-10">
                        <h5 class="card-title text-left"><?=$Lang->Units;?></h5>
                    </div>
                    <div class="col-lg-2 float-right m-b-10">
                         <div class="d-inline-block dropdown float-right">
                             <a href="edit.php" class="mb-2 btn btn-primary float-right icon-with-color" title="<?=$Lang->Add;?>">
                                 <span class="btn-icon-wrapper"><i id="add" class="metismenu-icon pe-7s-plus"></i></span>
                                 <?=$Lang->Add;?>
                             </a>
                         </div>
                        <div class="d-inline-block dropdown float-right ml-2 mr-2">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="mb-2 btn btn-primary float-right icon-with-color">
                                <i class="metismenu-icon pe-7s-print"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left append_printins">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover js-exportable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$Lang->title;?></th>
                            <th><?=$Lang->Subject;?></th>
                            <th><?=$Lang->Alignedstandards;?></th>
                            <th><?=$Lang->Domains;?></th>
                            <th><?=$Lang->Pivots;?></th>
                            <th><?=$Lang->Standards;?></th>
                            <th><?=$Lang->Courses;?></th>
                            <th><?=$Lang->Action;?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>title</td>
                                <td>Subject</td>
                                <td>Aligned standards</td>
                                <td>Domain</td>
                                <td>Pivots</td>
                                <td>Standards</td>
                                <td>Courses</td>

                                <td>
                                    <a class="icons-actions edit-row" href="edit.php" title="<?=$Lang->Edit;?>"><i class="metismenu-icon pe-7s-pen"></i></a>
                                    <a class="icons-actions delete-row delete-contract" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center d-inline-block m-auto">
            <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">??</span>
                            <span class="sr-only"><?=$Lang->GotoPreviousPage;?></span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link">2</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link">3</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link" aria-label="Next">
                            <span aria-hidden="true">??</span>
                            <span class="sr-only"><?=$Lang->GotoNextPage;?></span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
include_once "../../includes/footer.php";
?>




