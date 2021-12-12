<?php
$currentTab = "Pivots";

include_once "../../includes/header.php";

if(isset($_GET['showdeleted']) && $_GET['showdeleted']==1){
    $deleted='';
}else{
    $deleted=' AND `pivotes`.`deleted`=0 ';
}

$domain_filter="";
if(isset($_GET["domain"]) && $_GET["domain"]>0){
    $domain_filter=" AND `pivotes`.`pt_domain`=".$_GET["domain"];
}

$keyword_filter="";
if(isset($_GET["search"]) && $_GET["search"]!=""){
    $keyword="%".str_replace(" ","%",$_GET["search"])."%";
    $keyword_filter=" AND (`pivotes`.`pt_title_ar` like '".$keyword."' OR `domains`.`pt_title_en` like '".$keyword."') ";
}
$filters=$deleted.$domain_filter.$keyword_filter;

$sql="SELECT count(`pt_id`) as rows FROM `pivotes` WHERE `pt_id`>0 ".$filters;
$db = Database::getInstance();
$mysqli = $db->getConnection();
$result = $mysqli->query($sql);
$row=mysqli_fetch_assoc($result);

$link=$real_link;
$page=1;
if(isset($_GET["page"]) && $_GET["page"]!=""){
    $link=str_replace("&page=".$_GET["page"],"",$link);
    $page=$_GET["page"];
}

$url_arr=explode("/",$real_link);
$url_arr=explode("?",$url_arr[count($url_arr)-1]);
$url = $url_arr[0]."?";

if(strpos($link,"?")===false){
    $url = $url_arr[0]."?";
}else{
    $arr=explode("?",$link);
    $getData=explode("&",$arr[1]);
    $url = $url_arr[0]."?".$arr[1];
}



$pagination=getPagination($url,$row["rows"]);
$sql="SELECT `pivotes`.*,`domains`.*,`categories`.`name_".$db_lang."` as subject FROM `pivotes` LEFT JOIN `domains` ON `pivotes`.`pt_domain`=`domains`.`dn_id` LEFT JOIN `categories` ON `domains`.`dn_category`=`categories`.`catid` WHERE `domains`.`dn_id`>0 ".$filters." ". $pagination[0];
$result= $mysqli->query($sql);

?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-5 float-right m-b-10">
                        <h5 class="card-title text-left"><?=$Lang->Pivots;?></h5>
                    </div>
                    <form id="search_form" METHOD="get">
                        <div class="col-lg-4 float-left">
                            <input type="hidden" name="search" id="search_keyword" value="<?php if(isset($_GET["search"]) && $_GET["search"]!=""){echo $_GET["search"];}?>">
                            <div class="position-relative form-group top-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="Category" class="float-left"><?=$Lang->Alignedstandards;?></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <?php
                                        getAlignedStandard("change_submit");
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 float-left">
                            <div class="position-relative form-group top-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="Category" class="float-left"><?=$Lang->Subject;?></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <?php
                                        getCategories("change_submit");
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 float-left">
                            <div class="position-relative form-group top-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="Category" class="float-left"><?=$Lang->Domains;?></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <?php
                                        getDomains("change_submit");
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
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
                            <th><?=$Lang->Subject;?></th>
                            <th><?=$Lang->Domains;?></th>
                            <th><?=$Lang->titleAr;?></th>
                            <th><?=$Lang->titlEn;?></th>
                            <th><?=$Lang->Action;?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Subject</td>
                                <td>Domain</td>
                                <td>Title Ar</td>
                                <td>Title (En)</td>
                                <td>
                                    <a class="icons-actions edit-row" href="edit.php" title="<?=$Lang->Edit;?>"><i class="metismenu-icon pe-7s-pen"></i></a>
                                    <a class="icons-actions delete-row delete-contract" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="icons-actions sort-row sort-contract" href="sort.php" title="<?=$Lang->SortBy;?>"><i class="metismenu-icon pe-7s-way"></i></a>
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
                            <span aria-hidden="true">»</span>
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




