<?php
$currentTab = "Home";
include_once "../includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-7">
                        <h5 class="card-title text-left">home</h5>
                    </div>
                    <div class="col-lg-5">
                        <div class="col-lg-9 float-left">
                            <div class="position-relative form-group top-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="Category" class="float-left">categories</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="Category" id="Category" class="form-control">
                                             <option  value="-1">----</option>
                                             <option  value="-1">----</option>
                                             <option  value="-1">----</option>
                                             <option  value="-1">----</option>
                                             <option  value="-1">----</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 float-left">
                            <div class="d-inline-block dropdown float-right">
                                <a href="" class="mb-2 btn btn-primary float-right icon-with-color" title="">
                                    <span class="btn-icon-wrapper pr-2"><i id="addcontract" class="metismenu-icon pe-7s-plus"></i></span>
                                    add
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">2</th>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td><a class="icons-actions edit-row" href="" title=""><i class="metismenu-icon pe-7s-pen"></i></a>
                                  <a class="icons-actions delete-row delete-contract" title=""><i class="metismenu-icon pe-7s-trash"></i></a>
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
                            <span aria-hidden="true">«</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link">1</a>
                    </li>
                    <li class="page-item">
                        <a href="javascript:GotoPage(0);" class="page-link" aria-label="Next">
                            <span aria-hidden="true">»</span>
                            <span class="sr-only">Next</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
include_once "../includes/footer.php";
?>




