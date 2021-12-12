<?php
$cuerrentpage="quiz.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}else if($_SESSION["user"]['permession']==3){
    header('Location:warehouse.php');
}else if($_SESSION["user"]['permession']==4){
    header('Location:shippingwarehouse.php');
}
include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="quiz.php" class="floating-left active">'.$Lang->Quiz.'</a></li>';

include "includes/header.php";
?>
<script type="text/javascript" >
    function deletequize(id){


        swal({
            title: window.Lang['Areyousure'],
            text: window.Lang['Youwillnotbeabletorecoverthismedia'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {


                $.ajax({
                    url: "ajax/platform.php?process=deletequiz",
                    type: "POST",
                    data:{"quizid":id},
                    cache: false,
                    dataType:'json',
                    success: function(jsonData) {
                        if(jsonData.result==1){

                            swal(window.Lang['Deleted'],window.Lang['mediahasbeendeleted'],'success');
                            window.location=window.location;
                        }else{
                            swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
                        }
                    }
                });





            } else {
                swal(window.Lang['Cancelled'],window.Lang['Youruserissafe'],'error');
            }
        });






    }


</script>
    <div class="books-container">
        <label class="lbl-data-a floating-left"><?= $Lang->Category ?></label>
        <select class="txt-a floating-left" id="Category_quiz" name="Category">
            <option value='0'>-----------</option>
            <?php
            $keywords='';

            if(isset($_GET["keywords"])){
                $keywords=$_GET["keywords"];
            }
            $cat_sql = "Select * From  categories ";
            $cat_result = $con->query($cat_sql);
            if (mysqli_num_rows($cat_result) > 0) {
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    $selected='';
                    if(isset($_GET["category"])){
                        if($cat_row['catid']==$_GET["category"]){
                            $selected='selected';
                        }
                    }
                    echo "<option ".$selected." value='".$cat_row['catid']."'>".$cat_row['name_'.$lang_code]."</option>";
                }
            }
            ?>
        </select>
        <input type="text" class="txt-a floating-left book-serach" id="quiz_search" name="quiz_search" placeholder="<?= $Lang->search ?>" value="<?=$keywords;?>">
        <input type="button" class="btn-default-b floating-left" value="<?= $Lang->search ?>" onclick="searchQuiz();">
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell quiz-number"><?= $Lang->No?></div>
                <div class="display-table-cell quiz-user"><?= $Lang->User ?></div>
                <div class="display-table-cell quiz-category"><?= $Lang->Category ?></div>
                <div class="display-table-cell quiz-book-title"><?= $Lang->QuizTitle ?></div>
                <div class="display-table-cell quiz-created-at"><?= $Lang->CreatedDate ?></div>
                <div class="display-table-cell quiz-action"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            if ($_SESSION['user']['permession'] == 1) {
                $weruser = '';
            } else {
                $weruser = "and quiz.userid=" . $_SESSION['user']['userid'];
            }
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND `title` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'";
            }
            $cat_filter="";
            if(isset($_GET['category']) && $_GET['category']!=0){
                $cat_filter=" AND `catid` = ".$_GET['category'];
            }
            $sql = "Select   quiz.*,  categories.name_ar,  categories.name_en,  users.fullname From  quiz Left Join  categories On quiz.category = categories.catid Inner Join  users On quiz.userid = users.userid   WHERE `quizid` >0  " . $weruser .$keyword_filter.$cat_filter."   ";
            $result = $con->query($sql);
            $url="quiz.php?".$keywords;
            $result = $con->query($sql);
            $num_rows=mysqli_num_rows($result);
            $pagination=getPagination($url,$num_rows);
            $sql = "Select   quiz.*,  categories.name_ar,  categories.name_en,  users.fullname From  quiz Left Join  categories On quiz.category = categories.catid Inner Join  users On quiz.userid = users.userid   WHERE `quizid` >0  " . $weruser .$keyword_filter.$cat_filter.$pagination[0];
            $result = $con->query($sql);
            $data = '';
            if (mysqli_num_rows($result) > 0) {
                // output data of each row

                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $data .= "<div id='quizidd_".$row['quizid']."' class='display-table-row #class#'>";
                    $data .= "<div class='display-table-cell quiz-number' >".$i."</div>";
                    $data .= "<div class='display-table-cell quiz-user'>".$row['fullname']."</div>";
                    $data .= "<div class='display-table-cell quiz-category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell quiz-book-title'>".$row['title']."</div>";
                    $data .= "<div class='display-table-cell quiz-created-at'>".$row['cdate']."</div>";

                    $data .= "<div class='display-table-cell quiz-action'>";
                    $data .= "<div class='butons-container'>";

                    $data .= " <a href='quiz-editor?id=".$row['quizid']."' title='$Lang->QuizInformation'>";
                    $data .= " <i class='flaticon-info27'></i></a>";

                        $data .= " <a href='javascript:deletequize(".$row['quizid'].")' title='$Lang->Delete'>";
                        $data .= " <i class='flaticon-delete96'></i> </a>";
                        $data .= "<a href='javascript:previewquiz(".$row['quizid'].")' title=' $Lang->Preview '>";
                        $data .= "<a href='quiz/view/".strtolower($row['language'])."/index.php?id=".$row['quizid']."' target='_blank' title=' $Lang->Preview '>";
                        $data .= " <i class='flaticon-eye106'></i></a>";
                    $data .= "</div></div></div>";
                    $i++;
                }
            }

            echo $data;
            ?>

            <!--end table rows-->
        </div>
        <a href="editquiz.php?type=new" class="btn-default floating-right"><?=$Lang->AddQuiz;?></a>
    </div>
    <section class="paging">
        <div class="content">
            <?php


            echo $pagination[1];
            ?>

        </div>
    </section>

<?php
include "includes/footer.php";
?>