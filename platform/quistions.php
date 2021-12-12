<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
}

if(!isset($_GET['id']) || $_GET['id']==""){
    header('Location: quiz.php');
    exit();
}
include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');
include "includes/header.php";

?>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="../js/jquery-ui.js"></script>
    <script type = "text/javascript" src = "../js/matchingjs_new.js" ></script >

    <script src="../js/quistions.js"></script>
    <script type="text/javascript" src="../js/sweetalert-dev.js"></script>
    <style>
        #sortable-a { list-style-type: none; margin: 0; padding: 0; }
        #sortable-a li { margin: 0 0px 3px 0px;cursor: move;background: #FFFCFC}
        #sortable-a li span { position: absolute; margin-left: -1.3em; color: #464646;display: none}
        .ui-state-default-placeholder
        {
            overflow: visible;
            border: dashed 2px #00ab67 !important;
        }
    </style>
  <script>

  $(function() {
    $( "#sortable-a" ).sortable({
        placeholder: 'ui-state-default-placeholder'
    });
    $( "#sortable-a" ).disableSelection();
  });
  </script>
    <div class="books-container">





        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell question-number"><?= $Lang->No ?></div>
                <div class="display-table-cell question-user"><?= $Lang->QuizTitle  ?></div>
                <div class="display-table-cell question-book-title"><?= $Lang->QuizType  ?></div>
                <div class="display-table-cell question-action"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php



            $sql = "Select  questions.*,  quiztype.name_ar,  quiztype.name_en From  questions Left Join  quiztype On questions.type = quiztype.id Where  questions.quizid > 0 AND questions.quizid=".$_GET['id']."  Order By  questions.quiz_sort" ;
            $result = $con->query($sql);
            $data = '<ul id="sortable-a">';
            if (mysqli_num_rows($result) > 0) {
                // output data of each row

                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $data .= "<li sort='".$row['quistionid']."' class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>";
                    $data .= "<div id='quizidd_".$row['quizid']."' class='display-table-row #class#'>";
                    $data .= "<div class='display-table-cell question-number' >".$i."</div>";
                    $data .= "<div class='display-table-cell question-user'>".$row['question']."</div>";
                    $data .= "<div class='display-table-cell question-book-title'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";


                    $data .= "<div class='display-table-cell question-action'>";
                    $data .= "<div class='butons-container'>";
                    $data .= " <a title='$Lang->Edit' href='quiz_editor.php?quizid=".$row['quizid']."&questionid=".$row['quistionid']."'>";
                    $data .= " <i class='flaticon-pencil43'></i></a>";
                    $data .= " <a title='$Lang->ViewQuiz' href=javascript:viewquiz(".$row['quizid'].",".$row['quistionid'].")>";
                    $data .= " <i class='flaticon-eye106'></i></a>";
                    if ($_SESSION['user']['permession'] == 1) {
                        $data .= " <a title='$Lang->Delete' href='javascript:deletequistion(".$_GET['id'].",".$row['quistionid'].")' >";
                        $data .= " <i class='flaticon-delete96'></i> </a>";

                    }
                    $data .= "</div></div></div></li>";
                    $i++;

                }

            }
            $data.="</ul>";
            echo $data;
            ?>

            <!--end table rows-->
        </div>
        <a href="quiz_editor.php?quizid=<?=$_GET['id'];?>&type=new" class="btn-default floating-right"><?=$Lang->AddQuestion;?></a>
        <?php
        if (mysqli_num_rows($result) > 0) {

        ?>
        <a href="javascript:savesortquistion(<?=$_GET['id'];?>)" class="btn-default floating-right"><?=$Lang->Save;?></a>
            <?php
        }
        ?>
    </div>
    <div class="admin-login" id="popup" style="display: none;">
        <div class="popup-main-container">
            <div class="popup-tabel">
                <div class="popup-row">
                    <div class="popup-cell">
                        <div class="popup-container">
                            <label class="close-container">
                                <i class='flaticon-back57 floating-left' id="back_icon" style="display: none" onclick='$(this).hide();$("#viewquistion_iframe" ).contents().find( "#viewImage" ).attr("src","");$("#viewquistion_iframe" ).contents().find( ".view-container" ).hide();'></i>
                                <i class="flaticon-x floating-right close"></i>
                            </label>
                            <div class="popup-content">
                                <div class="container" id="viewquistion_container" style="overflow: auto;max-height: 800px;min-height:300px;border: 1px solid #00AB67;padding: 20px;background: #fff">
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