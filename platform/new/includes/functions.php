<?php
function getPagination($url,$num_rows,$rows=BooksPerPage){
    global $Lang;
    if(isset($_GET['page'])){
        $current=$_GET['page'];
    }else{
        $current=1;
    }
    $result1[0]="";
    $result1[1]="";
    $prev=$current-1;
    $next=$current+1;
    $Pages_number=ceil($num_rows/$rows);
    if($Pages_number>1){
        if($current>PagesOfPagination/2){
            $pageBegin=($current-ceil(PagesOfPagination/2))+1;
            if($Pages_number>PagesOfPagination){
                $pageEnd=($current+ceil(PagesOfPagination/2))-1;
            }else{
                $pageEnd=$Pages_number;
            }
        }else{
            $pageBegin=1;
            if($Pages_number>PagesOfPagination){
                $pageEnd=PagesOfPagination;
            }else{
                $pageEnd=$Pages_number;
            }
        }
        if($pageEnd>$Pages_number){
            $pageEnd=$Pages_number;
            if($Pages_number-PagesOfPagination+1>0){
                $pageBegin=$Pages_number-PagesOfPagination+1;
            }else{
                $pageBegin=1;
            }
        }
        if($pageBegin>1 && $Pages_number-$pageBegin<PagesOfPagination-1){
            $pageBegin=1;
        }


        //echo "<script>alert('".$pageBegin.'>>'.$pageEnd."');</script>";
        $result="";
        for($i=$pageBegin;$i<=$pageEnd;$i++){
            if($current==$i){
                $result.="<li class='page-item active'><a class='page-link'  href='".$url."&page=".$i."' >$i</a></li>";
            }else{
                $result.="<li class='page-item'><a class='page-link'  href='".$url."&page=".$i."' >$i</a></li>";
            }
        }
        if($current!=1){
            $first="<li class='page-item'><a class='page-link' aria-label='Previous'  href='".$url."&page=".$i."' ><span aria-hidden='true'>«</span><span class='sr-only'><?=$Lang->GotoPreviousPage;?></span></a></li>";
        }else{
            $first="";
        }
//        if($prev>0){
        /*            $previus="<li class='page-item'><a class='page-link' aria-label='Next'  href='".$url."&page=".$i."' ><span aria-hidden='true'>»</span>  <span class='sr-only'><?=$Lang->GotoNextPage;?></span></a></li>";*/
//        }else{
//            $previus="";
//        }

        if($Pages_number!=$current){
            $last="<li class='page-item'><a class='page-link' aria-label='Next'  href='".$url."&page=".$i."' ><span aria-hidden='true'>»</span>  <span class='sr-only'><?=$Lang->GotoNextPage;?></span></a></li>";
        }else{
            $last="";
        }
//        if($next<=$Pages_number){
//            $next_link=" <a href='".$url."&page=$next' class='next floating-left'><i class='flaticon-right-arrow26'></i></a>";
//        }else{
//            $next_link="";
//        }
        $begin=$current*$rows-($rows);
        $result1[0]=" LIMIT " . $begin . ", " . $rows;
        $result1[1]=$first.$result.$last;
    }
    return $result1;
}

function getCategories($class="",$select=0){
    $sql="SELECT * FROM `categories`";
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $result = $mysqli->query($sql);

    echo '<select name="subject" id="subject" class="form-control '.$class.'">';
    echo '<option value="0">------</option>';
    while ($row=mysqli_fetch_assoc($result)){
        $selected="";
        if((isset($_GET["subject"]) && $_GET["subject"]==$row["catid"]) || $select==$row["catid"]){
            $selected='selected';
        }
        echo '<option '.$selected.' value="'.$row["catid"].'">'.$row["name_ar"].'</option>';
    }
    echo '</select>';
}
function getAlignedStandard($class="",$select=0){
    $sql="SELECT * FROM `aligned_standards` WHERE `status`=1 AND deleted=0";
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $result = $mysqli->query($sql);

    echo '<select name="astandard" id="astandard" class="form-control '.$class.'">';
    echo '<option value="0">------</option>';
    while ($row=mysqli_fetch_assoc($result)){
        $selected="";
        if((isset($_GET["astandard"]) && $_GET["astandard"]==$row["as_id"]) || $select==$row["as_id"]){
            $selected='selected';
        }
        echo '<option '.$selected.' value="'.$row["as_id"].'">'.$row["as_title_ar"].'</option>';
    }

    echo '</select>';
}
function getDomains($class="",$select=0,$aligned_standards=0){
    if($aligned_standards!=0){
        $sql="SELECT * FROM `domains` WHERE `status`=1 AND deleted=0 AND dn_astandard=".$aligned_standards;
    }else{
        $sql="SELECT * FROM `domains` WHERE `status`=1 AND deleted=0";
    }

    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    $result = $mysqli->query($sql);

    echo '<select name="domain" id="domain" class="form-control '.$class.'">';
    echo '<option value="0">------</option>';
    while ($row=mysqli_fetch_assoc($result)){
        $selected="";
        if((isset($_GET["domain"]) && $_GET["domain"]==$row["dn_id"]) || $select==$row["dn_id"]){
            $selected='selected';
        }
        echo '<option '.$selected.' value="'.$row["dn_id"].'">'.$row["dn_title_ar"].'</option>';
    }

    echo '</select>';
}

function checkPermission(){
    if(!(isset($_SESSION["user"]) && $_SESSION["user"]["permession"]>0 && $_SESSION["user"]["permession"]<4)){
       echo 'no permission';
        exit();
    }
}