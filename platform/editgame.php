<?php

/**

 * User: Hussam Abu Khadijeh    Dar Al-Manhal

 * Date: 13/12/2016

 * Time: 2:27 PM

 */

$cuerrentpage="games.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}



include_once('config.php') ;
include_once('includes/language.php') ;
include_once('includes/function.php') ;



if(isset($_GET['id']) && $_GET['id']=="new"){

    if(isset($_GET["copy"]) && $_GET["copy"]!=""){
        $sql = "SELECT `editors`.*,`categories`.* FROM `editors` left OUTER JOIN `categories` ON `editors`.`category`=`categories`.`catid`  WHERE `editors`.`gameid`=".$_GET["copy"];
        $result=$con->query($sql);
        $row=mysqli_fetch_assoc($result);

        $sql ="INSERT INTO `editors`(`gameid`, `title_ar`, `title_en`, `description_ar`, `description_en`, `category`, `grade`, `thumb`, `type`, `data`, `userid`, `cdate`, `status`, `editor`, `price`, `language`, `bookid`)
 VALUES ('','copy of ".mysqli_escape_string($con,$row["title_ar"])."','copy of ".mysqli_escape_string($con,$row["title_en"])."','".mysqli_escape_string($con,$row["description_ar"])."',
 '".mysqli_escape_string($con,$row["description_en"])."',".$row["category"].",'".$row["grade"]."','".mysqli_escape_string($con,$row["thumb"])."','".$row["type"]."', '".mysqli_escape_string($con,$row["data"])."',
 ".$_SESSION["user"]["userid"].",NOW(),0,'".mysqli_escape_string($con,$row["editor"])."',".$row["price"].",'".mysqli_escape_string($con,$row["language"])."',".$row["bookid"].")";
        $con->query($sql);
        $id=mysqli_insert_id($con);
        copyDirectory('games/'.$_GET["copy"],'games/'.$id);

    }else{
        if(isset($_GET["platform"]) && $_GET["platform"]=="imanhal"){
            if(!isset($_SESSION["user"]["userid"]) ||$_SESSION["user"]["userid"]<1){
                $_SESSION["user"]["userid"]=4;
                $_SESSION["user"]["permession"]=2;
            }
            $sql ="INSERT INTO editors (gameid,userid,cdate,category,grade,editor,language) VALUES ('',".$_SESSION["user"]["userid"].",NOW(),1,4,'click_map','Ar')";
            $con->query($sql);
            $id=mysqli_insert_id($con);

            $path="platform/click_map/viewer/ar/index.php?id=".$id;
            $sql="INSERT INTO `media`(`id`, `title_ar`, `title_en`, `category`, `userid`, `cdate`, `status`, `language`, `description_en`, `description_ar`, `price`, `grade`, `type`,`path`, `productid`) VALUES
            ('','','".mysqli_real_escape_string($con,'')."',1,4,CURDATE(),0,
            'Ar','','',0,4,11,'".$path."',".$id.")";
            $con->query($sql);
        }else{
            $sql ="INSERT INTO editors (gameid,userid,cdate) VALUES ('',".$_SESSION["user"]["userid"].",NOW())";
            $con->query($sql);
            $id=mysqli_insert_id($con);
        }




    }


    if(isset($_GET["platform"]) && $_GET["platform"]=="imanhal"){
        if(!isset($_SESSION["user"]["userid"]) ||$_SESSION["user"]["userid"]<1){
            $_SESSION["user"]["userid"]=4;
            $_SESSION["user"]["permession"]=2;
        }
        header("location: click_map/index.php?id=".$id);
        exit();
    }else{
        header("location: editgame.php?gameid=".$id);
        exit();
    }

}

if(isset($_GET["platform"]) && $_GET["platform"]=="imanhal"){
    if(!isset($_SESSION["user"]["userid"]) ||$_SESSION["user"]["userid"]<1){
        $_SESSION["user"]["userid"]=4;
        $_SESSION["user"]["permession"]=2;
    }
    header("location: click_map/index.php?id=".$_GET['id']);
    exit();
}




$sql = "SELECT `editors`.*,`categories`.* FROM `editors` left OUTER JOIN `categories` ON `editors`.`category`=`categories`.`catid`  WHERE `editors`.`gameid`=".$_GET["gameid"];



$result = $con->query($sql);

//if (mysqli_num_rows($result) > 0) {

$data='';

$row = mysqli_fetch_assoc($result);

//}

?>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->

<!--<script type="text/javascript" src="js/ajax.js"></script>-->







<?php
$bredcrumb = '<li class="floating-left"><a href="games.php" class="floating-left active">'.$Lang->Games.'</a></li><span class="floating-left">/</span><li class="floating-left"><a class="floating-left active">'.$Lang->EditGames.'</a></li>';

include "includes/header.php";

?>

<script type="text/javascript" >

    ////start khalid 19-9-2016


function changelisteditor(){
    if($("#gametype").val()=='coloring') {
        $("#Coloring_image_upload").show();
    }else{
        $("#Coloring_image_upload").hide();
    }

}

    $(document).ready(function(){
        $("#gametype").change(function(){
            changelisteditor()
        })
        changelisteditor()
    })



    function removeimage(image) {

        $(image).parent().find('#scrimg').hide();

        setdata = {TypeProcesses: 'deletefile',file:"../"+ $(image).parent().find('#scrimg').attr('src')};

        $.ajax({

            url: "ajax/function.php",

            type: "POST",

            data: setdata,

            cache: false,

            dataType: 'html',



            success: function (html) {

                console.clear();

                console.log(html);



            }

        });

    }

    function removesound(sound) {

        setdata = {TypeProcesses: 'deletefile',file:"../"+sound};

        $.ajax({

            url: "ajax/function.php",

            type: "POST",

            data: setdata,

            cache: false,

            dataType: 'html',



            success: function (html) {

                console.clear();

                console.log(html);



            }

        });

    }



    ////end khalid 19-9-2016

</script>

<div class="edit-book">
    <div class="form-container">

        <form id="editbook">

            <input type="hidden" name="game_id" id="game_id" value="<?= $_GET['gameid']; ?>">

            <div class="display-inline-block floating-left">

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->arabictitle ?></label>

                    <input type="text" class="txt-a floating-left" id="title_ar" name="title_ar" placeholder="<?= $Lang->arabictitle ?>" value="<?=$row["title_ar"];?>">

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->englishtitle ?></label>

                    <input type="text" class="txt-a floating-left" id="title_en" name="title_en" placeholder="<?= $Lang->englishtitle ?>" value="<?=$row["title_en"];?>">

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?=$Lang->Age;?>

                    </label>

                    <select class="txt-a floating-left" id="game_age" name="game_age">

                        <option value="-1" <?php if($row["grade"]==-1){echo 'selected';}?> ><?=$Lang->all;?></option>

                        <option value="1" <?php if($row["grade"]==1){echo 'selected';}?> >4-5</option>

                        <option value="2" <?php if($row["grade"]==2){echo 'selected';}?> >6-8</option>

                        <option value="3" <?php if($row["grade"]==3){echo 'selected';}?> >9-11</option>

                        <option value="4" <?php if($row["grade"]==4){echo 'selected';}?> >12-15</option>

                    </select>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->Price;?></label>

                    <input type="text" class="txt-a floating-left" id="game_price" name="game_price" placeholder="<?= $Lang->Price;?>" value="<?=$row["price"]; ?>">

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?= $Lang->Category?>

                    </label>

                    <select class="txt-a floating-left" id="category" name="category">

                        <?php

                        $cat_sql = "Select * From  categories";

                        $cat_result = $con->query($cat_sql);

                        if(mysqli_num_rows($cat_result) > 0){

                            while($cat_row = mysqli_fetch_assoc($cat_result)){

                                $selected='';

                                if($cat_row['catid']==$row["catid"]){

                                    $selected='selected';

                                }

                                echo "<option ".$selected." value='".$cat_row['catid']."'>".$cat_row['name_'.$lang_code]."</option>";

                            }

                        }

                        ?>

                    </select>

                </div>

            </div>

            <div class="display-inline-block floating-left">

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?=$Lang->GameType;?>

                    </label>

                    <select class="txt-a floating-left" id="gametype" name="gametype">

                        <option <?php if($row["editor"]=='labeling'){echo "selected='selected'";}?> value='labeling'>Labeling</option>

                        <option <?php if($row["editor"]=='connected_dots'){echo "selected='selected'";}?> value='connected_dots'>Connected Dots</option>

                        <option <?php if($row["editor"]=='find_object'){echo "selected='selected'";}?> value='find_object'>Find Objects</option>

                        <option <?php if($row["editor"]=='click_map'){echo "selected='selected'";}?> value='click_map'>Click Map</option>
                        <option <?php if($row["editor"]=='matching'){echo "selected='selected'";}?> value='matching'>Matching</option>
                        <option <?php if($row["editor"]=='fill_in_the_blanks'){echo "selected='selected'";}?> value='fill_in_the_blanks'>fill in the blanks</option>
                        <option <?php if($row["editor"]=='coloring'){echo "selected='selected'";}?> value='coloring'>coloring</option>
                        <option <?php if($row["editor"]=='difference_between'){echo "selected='selected'";}?> value='difference_between'>difference between</option>
                        <option <?php if($row["editor"]=='maze'){echo "selected='selected'";}?> value='maze'>maze</option>
                        <option <?php if($row["editor"]=='tracing'){echo "selected='selected'";}?> value='tracing'>Tracing</option>
                    </select>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?=$Lang->Language;?>

                    </label>

                    <select class="txt-a floating-left" id="language" name="language">

                        <option <?php if($row["language"]=='Ar'){echo "selected='selected'";}?> value='Ar'><?=$Lang->Arabic;?></option>

                        <option <?php if($row["language"]=='En'){echo "selected='selected'";}?> value='En'><?=$Lang->English;?></option>

                        <option <?php if($row["language"]=='Fr'){echo "selected='selected'";}?> value='Fr'><?=$Lang->France;?></option>

                    </select>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?=$Lang->Book;?>

                    </label>

                    <select class="txt-a floating-left" id="book" name="book">

                        <option value='0'>-------------------------</option>

                        <?php

                        $books_sql = "Select books.bookid,books.name From  books";

                        $books_result = $con->query($books_sql);

                            while($books_row = mysqli_fetch_assoc($books_result)){

                                $selected='';

                                if($books_row['bookid']==$row["bookid"]){

                                    $selected='selected';

                                }

                                echo "<option ".$selected." value='".$books_row['bookid']."'>".$books_row['name']."</option>";

                            }



                        ?>

                    </select>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->DescriptionAr;?></label>

                    <textarea class="floating-left txt-b" name="descriptionar" id="descriptionar" placeholder="<?= $Lang->DescriptionAr;?>"><?=$row['description_ar'];?></textarea>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->DescriptionEn;?></label>

                    <textarea class="floating-left txt-b" name="descriptionen" id="descriptionen" placeholder="<?= $Lang->DescriptionEn;?>"><?=$row['description_en'];?></textarea>

                </div>



                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->Thumb;?></label>

                    <div class="fu-container-a floating-left">

                        <label class="floating-left flaticon-cloud148 label-a"></label>

                        <label class="label-b floating-left" id="lblbook_cover"></label>

                        <input onchange="readImg(this,'thumb_img')" class="txt-a floating-left" id="thumb" type="file" name="thumb" placeholder="<?= $Lang->Thumb;?>" value="">

                    </div>

                    <?php

                    if(is_file("games/".$row["gameid"]."/images/thumb.jpg")){

                        $src="games/".$row["gameid"]."/images/thumb.jpg";

                    }else{

                        $src="";

                    }

                    ?>

                    <img class="book-cover-img floating-left" id="thumb_img" src="<?=$src;?>">

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->image_larg;?></label>

                    <div class="fu-container-a floating-left">

                        <label class="floating-left flaticon-cloud148 label-a"></label>

                        <label class="label-b floating-left" id="lblbook_cover"></label>

                        <input onchange="readImg(this,'image_larg_img')" class="txt-a floating-left" id="image_larg" type="file" name="image_larg" placeholder="<?= $Lang->image_larg;?>" value="">

                    </div>

                    <?php

                    if(is_file("games/".$row["gameid"]."/images/image_larg.jpg")){

                        $src="games/".$row["gameid"]."/images/image_larg.jpg";

                    }else{

                        $src="";

                    }

                    ?>

                    <img class="book-cover-img floating-left" id="image_larg_img" src="<?=$src;?>">

                </div>




                <div id="Coloring_image_upload" style="display: none" class="line-row">

                    <label class="lbl-data-a floating-left">Coloring</label>

                    <div class="fu-container-a floating-left">

                        <label class="floating-left flaticon-cloud148 label-a"></label>

                        <label class="label-b floating-left" id="lblbook_cover"></label>

                        <input onchange="readImg(this,'Coloring_img')" class="txt-a floating-left" id="Coloring" type="file" name="Coloring" placeholder="Coloring" value="">

                    </div>

                    <?php

                    if(is_file("games/".$row["gameid"]."/images/Coloring_image.png")){

                        $src="games/".$row["gameid"]."/images/Coloring_image.png";

                    }else{

                        $src="";

                    }

                    ?>

                    <img class="book-cover-img floating-left" id="Coloring_img" src="<?=$src;?>">

                </div>


        </form>

        <div class="line-row">

            <label class="lbl-data-a floating-left"><?= $Lang->isPublished;?></label>

            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished" value='<?=$row['status'];?>' <?php if($row['status']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="ispublished"><?=$Lang->isPublished;?></label>

        </div>

    </div>

    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>

    <input name="commit" id="update_game_editor" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">

</div>

</div>

<?php

include "includes/footer.php";

?>

