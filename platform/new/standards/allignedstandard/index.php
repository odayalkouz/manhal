<?php
$currentTab = "allignedstandard";

include_once "../../includes/header.php";
checkPermission();

if(isset($_GET['showdeleted']) && $_GET['showdeleted']==1){
    $deleted='';
}else{
    $deleted=' AND `aligned_standards`.`deleted`=0 ';
}

$sql = "SELECT * FROM `aligned_standards` where `aligned_standards`.`as_id`>0 ".$deleted;
$result = $con->query($sql);
$url="index.php?";
$result = $con->query($sql);
$num_rows=mysqli_num_rows($result);
$pagination=getPagination($url,$num_rows);




$sql = "SELECT * FROM `aligned_standards` where `aligned_standards`.`as_id`>0 ".$deleted.$pagination[0];
$result = $con->query($sql);
$data = '';
$reset_counter=0;

if(isset($_GET["page"]) && $_GET["page"]>1){
    $reset_counter=BooksPerPage*($_GET["page"]-1);
}

?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".jq_delete_as").click(function () {
            as_id=$(this).attr('data-id');
            var a=$(this);
            Lobibox.confirm({
                title: 'Confirm',
                msg: "Are you sure you want to delete this Aligned Standard ? ",
                callback: function($this, type, ev){
                    if (type === 'yes'){
                        showLoader();
                        var data={as_id: as_id};
                        $.ajax({
                            url: "../ajax.php?process=deletealignedstandarad",
                            type: "POST",
                            data:data,
                            cache: false,
                            dataType: 'json',
                            success: function (jsonData) {
                                console.log("result",jsonData);
                                hideLoader();
                                if(jsonData.result){
                                    a.closest('tr').remove();
                                }else{
                                    console.log("result",jsonData);
                                    Lobibox.notify('error', {
                                        showClass: 'zoomInUp',
                                        hideClass: 'zoomOutDown',
                                        icon: false,
                                        msg: jsonData.msg
                                    });

                                }
                            }
                        });
                    }
                }
            });
        });
    });
</script>

<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-7">
                        <h5 class="card-title text-left"><?=$Lang->Alignedstandards;?></h5>
                    </div>
                    <div class="col-lg-5 float-right">
                        <div class="d-inline-block dropdown float-right ">
                            <a href="edit.php?id=new" class="mb-2 btn btn-primary float-right icon-with-color" title="<?=$Lang->Add;?>">
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
                    <table class="mb-0 table js-exportable js-basic-example dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$Lang->titleAr;?></th>
                            <th><?=$Lang->titlEn;?></th>
                            <th><?=$Lang->Action;?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1;
                        while ($row=mysqli_fetch_assoc($result)){
                            ?>

                            <tr>
                                <th scope="row"><?=$i;?></th>
                                <td><a href="../domains/index.php?astandard=<?=$row['as_id'];?>"><?=$row['as_title_ar'];?></a></td>
                                <td><a href="../domains/index.php?astandard=<?=$row['as_id'];?>"><?=$row['as_title_en'];?></a></td>
                                <td>
                                    <a class="icons-actions edit-row" href="edit.php?id=<?=$row['as_id'];?>" title="<?=$Lang->Edit;?>"><i class="metismenu-icon pe-7s-pen"></i></a>
                                    <a class="icons-actions delete-row delete-contract jq_delete_as" data-id="<?=$row['as_id'];?>" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center d-inline-block m-auto">
            <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                <ul class="pagination">
                    <?php
                    echo $pagination[1];
                    ?>
                </ul>
            </nav>
        </div>

    </div>
</div>
<?php
include_once "../../includes/footer.php";
?>




