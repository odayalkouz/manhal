<?php
$cuerrentpage = "category.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');

}
if ($_SESSION["user"]['permession'] != '1') {
    die();
}
include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="category.php" class="floating-left active">'.$Lang->Category.'</a></li>';

include "includes/header.php";
?>
    <style>

        .cf:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0;
        }
        * html .cf {
            zoom: 1;
        }
        *:first-child + html .cf {
            zoom: 1;
        }
        html {
            margin: 0;
            padding: 0;
        }
        body {
            font-size: 100%;
            margin: 0;
        }
        h1 {
            font-size: 1.75em;
            margin: 0 0 0.6em 0;
        }
        a {
            color: #01a951;
        }
        a:hover {
            text-decoration: none;
        }
        p {
            line-height: 1.5em;
        }
        .small {
            color: #666;
            font-size: 0.875em;
        }
        .large {
            font-size: 1.25em;
        }
        .dd {
            position: relative;
            display: block;
            margin: 0 auto;
            padding: 0;
            list-style: none;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-list {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .dd-list .dd-list {
            padding-left: 30px;
        }

        .dd-collapsed .dd-list {
            display: none;
        }

        .dd-item,
        .dd-empty,
        .dd-placeholder {
            display: block;
            position: relative;
            margin: 0;
            padding: 0;
            min-height: 20px;
            font-size: 13px;
            line-height: 20px;
        }

        .dd-handle {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-handle a
        {
            display:inline-block;
            overflow:hidden;
            padding: 0px 3px 0px 3px;
        }
        .dd-handle:hover {
            color: #00AB67;
            background: #fff;
        }
        .dd-item > button {
            display: block;
            position: relative;
            cursor: pointer;
            float: left;
            width: 25px;
            height: 20px;
            margin: 5px 0;
            padding: 0;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 0;
            background: transparent;
            font-size: 12px;
            line-height: 1;
            text-align: center;
            font-weight: bold;
        }
        .dd-item > button:before
        {
            content: '+';
            display: block;
            position: absolute;
            width: 100%;
            text-align: center;
            text-indent: 0;
        }
        .dd-item > button[data-action="collapse"]:before {
            content: '-';
        }

        .dd-placeholder,
        .dd-empty {
            margin: 5px 0;
            padding: 0;
            min-height: 30px;
            background: #f2fbff;
            border: 1px dashed #b6bcbf;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd-empty {
            border: 1px dashed #bbb;
            min-height: 100px;
            background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image: linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }

        .dd-dragel {
            position: absolute;
            pointer-events: none;
            z-index: 9999;
        }

        .dd-dragel > .dd-item .dd-handle {
            margin-top: 0;
        }

        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
            box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, .1);
        }

        .nestable-lists {
            display: block;
            clear: both;
            padding: 0px 0;
            width: 100%;
            border: 0;
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }

        #nestable-menu {
            padding: 0;
            margin: 20px 0;
        }

        #nestable-output
        @media only screen and (min-width: 700px) {

            .dd {
                float: none;
                width: 48%;
            }

            .dd + .dd {
                margin-left: 2%;
            }

        }

        .dd-hover > .dd-handle {
            background: #00AB67 !important;
        }

        /**
         * Nestable Draggable Handles
         */

        .dd3-content {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px 5px 40px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background: linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .dd3-content:hover {
            color: #00AB67;
            background: #fff;
        }

        .dd-dragel > .dd3-item > .dd3-content {
            margin: 0;
        }

        .dd3-item > button {
            margin-left: 30px;
        }

        .dd3-handle {
            position: absolute;
            margin: 0;
            left: 0;
            top: 0;
            cursor: pointer;
            width: 30px;
            text-indent: 100%;
            white-space: nowrap;
            overflow: hidden;
            border: 1px solid #aaa;
            background: #ddd;
            background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
            background: linear-gradient(top, #ddd 0%, #bbb 100%);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .dd3-handle:before {
            content: '???';
            display: block;
            position: absolute;
            left: 0;
            top: 3px;
            width: 100%;
            text-align: center;
            text-indent: 0;
            color: #fff;
            font-size: 20px;
            font-weight: normal;
        }

        .dd3-handle:hover {
            background: #ddd;
        }
    </style>
    <script>
        $(document).ready(function () {

            $("#save_category").click(function(){
                cat={};
                $(".dd-item").each(function(){
                    parentVal=$(this).closest("ol").closest(".dd-item").attr("data-id");
                    if(parentVal==undefined){
                        parentVal=0;
                    }
                    cat[$(this).attr("data-id")]=parentVal;

                    $.ajax({
                        url: "ajax/editor.php?process=sortcategories",
                        type: "POST",
                        cache: false,
                        dataType: 'html',
                        data:{"cats":JSON.stringify(cat)},
                        success: function (html) {

                        }
                    });
                });
            });

            var mouseIn = 0;
            $(".popup-container").mouseenter(function () {
                mouseIn = 1;
            });
            $(".popup-container").mouseleave(function () {
                mouseIn = 0;
            });
            $(".popup-main-container").click(function () {
                if (mouseIn == 0) {
                    $(".popup-main-container").fadeOut();
                }
            });
            $(".close").click(function () {
                $(".popup-main-container").fadeOut();
            });
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            $('#nestable').nestable({
                    group: 1
                })
                .on('change', updateOutput);
            updateOutput($('#nestable').data('output', $('#nestable-output')));
            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });
    </script>
    <div class="books-container">
        <div class="admin-login">
            <div class="popup-main-container" style="display: none;">
                <div class="popup-tabel">
                    <div class="popup-row">
                        <div class="popup-cell">
                            <div class="popup-container">
                                <label class="close-container">
                                    <i class='flaticon-back57 floating-left' id="back_icon" style="display: none"></i>
                                    <i class="flaticon-x floating-right close"></i>
                                </label>
                                <div class="popup-content">
                                    <div id="Container" class="container"
                                         style="overflow: auto;max-height: 800px;min-height:300px;border: 1px solid #00AB67;padding: 20px;background: #fff">
                                        <div class="sortable-main-container" style="display: inline-block;overflow:hidden;margin: 0 auto; width: 100%">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number-cat"><?= $Lang->No ?></div>
                <div class="display-table-cell user-cat"><?= $Lang->categoryname_en ?></div>
                <div class="display-table-cell category-cat"><?= $Lang->categoryname_ar ?></div>
                <div class="display-table-cell action-cat"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
<?php
function sortCat($cat)
{
    $cats=array();
    foreach ($cat as $category) {
        if($category['parent']==0){
            $category['kids'] = getCatChilds($cat,$category['catid']);
        }
        $cats[]=$category;
    }
    return $cats;
}
function getCatChilds($cat,$catid){

    $kids=array();
    $i=0;
    foreach($cat as $category){
        if($category['parent']==$catid){
            $category["kids"]=getCatChilds($cat,$category['catid']);
            $kids[]=$category;
        }
        $i++;
    }
    return $kids;
}
function getKids($category){
    global $temp_arr;
    if(isset($category['kids']) && $category['kids']!=null){
        echo '<ol class="dd-list">';
        foreach($category['kids'] as $key=>$kid){
            if(array_search($kid['catid'],$temp_arr)===false){
                $temp_arr[]=$kid['catid'];
                echo '<li id="categoryidd_'.$kid['catid'].'" class="dd-item" data-id="'.$kid['catid'].'">';
                echo '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">'.$kid['name_'.strtolower($_SESSION["lang"])];
                echo "<div class='floating-right'><a href='editcategory.php?id=" . $kid['catid'] . "'><i class='flaticon-pencil43'></i></a><a href='javascript:deletecategory(" . $kid['catid'] . ")' ><i class='flaticon-delete96'></i></a></div></div>";

                getKids($kid);
                echo '</li>';
            }
        }
        echo '</ol>';
    }
}
            $sql = "SELECT * FROM `categories` ORDER BY `parent`";

            $result = $con->query($sql);
            $data = '';
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $cat=array();
            while ($row = mysqli_fetch_assoc($result)) {
                $cat[]=$row;
            }
                $cat=sortCat($cat);
                $temp_arr=array();

                ?>
            <div class="sortable-main-container" style="display: inline-block;overflow:hidden;margin: 0 auto; width: 100%">
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        <ol class="dd-list">

                <?php
                foreach($cat as $category){
                    if(array_search($category['catid'],$temp_arr)===false){
                        echo '<li id="categoryidd_'.$category['catid'].'" class="dd-item" data-id="'.$category['catid'].'">';
                        echo '<div class="dd-handle dd3-handle">Drag</div><div class="dd3-content">'.$category['name_'.strtolower($_SESSION["lang"])];
                        echo "<div class='floating-right'><a href='editcategory.php?id=" . $category['catid'] . "'><i class='flaticon-pencil43'></i></a><a href='javascript:deletecategory(" . $category['catid'] . ")' ><i class='flaticon-delete96'></i></a></div></div>";
                        $temp_arr[]=$category['catid'];
                        getKids($category);
                        echo '</li>';
                    }
                }
//                $i = 0;
//                while ($row = mysqli_fetch_assoc($result)) {
//                    if ($i % 2 == 0) {
//                        $data .= "<div id='categoryidd_" . $row['catid'] . "' class='display-table-row bg-row-a' parent='".$row['catid']."'>";
//                    }else{
//                        $data .= "<div id='categoryidd_" . $row['catid'] . "' class='display-table-row bg-row'>";
//                    }
//                    $data .= "<div class='display-table-cell number-cat' >" . $i . "</div>";
//                    $data .= "<div class='display-table-cell user-cat'>" . $row['name_en'] . "</div>";
//                    $data .= "<div class='display-table-cell category-cat'>" . $row['name_ar'] . "</div>";
//
//
//                    $data .= "<div class='display-table-cell action-cat'>";
//                    $data .= "<div class='butons-container'>";
//                    $data .= " <a href='editcategory.php?id=" . $row['catid'] . "'>";
//                    $data .= " <i class='flaticon-pencil43'></i></a>";
//
//
//                    $data .= " <a href='javascript:deletecategory(" . $row['catid'] . ")' >";
//                    $data .= " <i class='flaticon-delete96'></i></a>";
//
//
//                    $data .= "</div></div></div>";
//                    $i++;
//
//                }
                ?>
                    </div></div></div>
                        <?php

            }

            echo $data;
            ?>

            <!--end table rows-->
        </div>
        <a href="createcategory.php" class="btn-default floating-right"><?= $Lang->AddCategory; ?></a>
        <a href="#" id="save_category" class="btn  btn-default floating-right"><?= $Lang->Save; ?></a>
    </div>

<?php
include "includes/footer.php";
?>