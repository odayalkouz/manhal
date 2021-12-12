<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="user.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}

if($_SESSION["user"]['permession']!='1'){
    die();
}

include_once('config.php') ;
include_once('includes/language.php') ;

$sql ="SELECT * FROM users WHERE userid=".$_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);
}

$bredcrumb = '<li class="floating-left"><a href="user.php" class="floating-left">'.$Lang->Users.'</a></li><span class="floating-left">/</span><li class="floating-left"><a class="floating-left ">Active Books for '.$row["uname"].'</a></li>';

include "includes/header.php";
?>
    <div class="edit-book">

        <div class="line-row">

            <label class="lbl-data-a floating-left"><?= $Lang->Book; ?></label>

            <div id="book_container" class="add-items-container floating-left">

                <?php
                $sql="SELECT * FROM `books` WHERE bookid in (SELECT `apps_codes`.`refid` FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='book' AND `apps_codes`.`enddate` > NOW() AND status=1 AND `codes_user`.`userid`=".$_GET["id"].")";
                $result = $con->query($sql);
                while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <div bookid="<?=$row["bookid"];?>" type="0" title="<?=$row["name"];?>" class="item-added floating-left"><label><?=$row["name"];?></label><span><i class="flaticon-delete96 jq_delete_active_book" bookid="<?=$row["bookid"];?>" userid="<?=$_GET["id"];?>"></i></span></div>
                    <?php
                }


                ?>
            </div>

            <a onclick='$("#popup_action").fadeIn();$("#getpage").attr("src","searchbookactive.php?userid=<?=$_GET["id"];?>")' class="add-button floating-left"><i class="flaticon-add64"></i></a>

        </div>

        <div class="line-row">

            <label class="lbl-data-a floating-left"><?= $Lang->Story; ?></label>

            <div id="story_container" class="add-items-container floating-left">

                <?php

                ?>

            </div>

            <a onclick='$("#popup_action").fadeIn();$("#getpage").attr("src","searchstories.php")' class="add-button floating-left"><i class="flaticon-add64"></i></a>

        </div>

        <input name="add" type="button" value="<?= $Lang->Add ?>" class="btn-default-a floating-left">
    </div>


    <div class="admin-login" id="popup_action" style="display:none ;">

        <div class="popup-main-container">

            <div class="popup-tabel">

                <div class="popup-row">

                    <div class="popup-cell">

                        <div class="popup-container">

                            <label class="close-container">

                                <i class="flaticon-x floating-right close" onclick='$("#popup_action").fadeOut();'></i>

                            </label>

                            <div class="popup-content">

                                <div class="containers" id="action_containerb">

                                    <iframe id="getpage" src="" style="width:1000px;height:600px;"></iframe>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php
include "includes/footer.php";
?>

<script>
    $(document).ready(function(){
        $(".jq_delete_active_book").click(function(){
            bookid=$(this).attr("bookid");
            userid=$(this).attr("userid");
            window.parent.$(".loader-table").show();
            a=$(this);
            $.ajax({
                url: "ajax/platform.php?process=deleteactivatebook",
                type: "POST",
                cache: false,
                dataType: 'html',
                data:{"bookid":bookid,"userid":userid},
                success: function (html) {
                    console.log(html);
                    window.parent.$(".loader-table").hide();
                    if(html==1){
                        a.closest(".item-added").remove();
                    }
                }
            });
        });
    });
</script>

