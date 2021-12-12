<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "includes/function.php";
include_once("includes/header.php");
?>
<form method="get">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/newsevent.css<?=$cash;?>">
    <?php
    if($detect->isMobile() || $detect->isTablet())
    {
        ?>
        <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/pronewsevent.css<?=$cash;?>">
        <?php
    }
    ?>

<div class=" inner-pages-main-container-events">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->Events; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="events-content">
        <div class="center-piece">
            <div class="inner-main-content-height">
            <div class="header">
                <label class="lbl-data-a floating-left"><?= $Lang->Year; ?></label>
                <div class="wrapper-demo floating-left">
                    <div id="NewsYaer" class="wrapper-dropdown-3" tabindex="1">
                        <?php
                        $url = "events?";
                        if(isset($_GET['year'])&&is_numeric($_GET['year'])) {
                            if($_GET['year']>2009 && $_GET['year']<date("Y")+2) {
                                $selectyear = $_GET['year'];
                            }else{
                                $selectyear= date("Y");
                            }
                        }else{
                            $selectyear= date("Y");
                        }
                        $url.='year='.$selectyear;
                        ?>
                        <span class="floating-left"><?php echo $selectyear;?></span>
                        <ul class="jq_bookdropdown dropdown submit scrollable ">
                            <?php
                            $year=2010;
                            while($year<date("Y")+2){
                                echo  '<li catid="'.$year.'" ><a title="'.$year.'" href="#"><i class="icon-truck icon-large"></i><span>'.$year.'</span></a></li>';
                                $year++;
                            }
                            ?>
                            <input class="hidden_input" type="hidden" name="year" value="<?php if(isset($_GET['year'])){ echo $_GET['year'];}else{echo $selectyear;} ?>" id="year">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="year-box reveal-top reveal_visible <?=ucfirst($cat_code);?>"><?php echo $selectyear;?></div>
                <?php
                $rightcontainer='';
                $leftcontainer='';
                $sql = "Select * From events where `startdate` LIKE  '%".$selectyear."%' ORDER BY  `events`.`startdate` ASC ";

                $result = $con->query($sql);
                $i=0;
                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $viewLink=SITE_URL.$lang_code."/events/".$row['eventid']."/".str_replace(" ","-",$row['title_'.$_SESSION["lang"]]);
                        $rightcontainer='';
                        $leftcontainer='';
                        if($i%2==0 ){
                            $leftcontainer.=' <div class="things-container clear-both"><div class="left-container floating-left">';
                            $leftcontainer.='<div class="row-container left first-row reveal-left reveal_visible">';
                            $leftcontainer.='<div class="rectangle floating-left">';
                            $leftcontainer.='<div class="square floating-left">';
                            $leftcontainer.='<a class="event-anchor">';
                            $leftcontainer.='<label>'.date('d',strtotime($row['startdate'])).'</label>';
                            $leftcontainer.='<span>'.date('M',strtotime($row['startdate'])).'</span>';
                            $leftcontainer.='</a>';
                            $leftcontainer.='<a href="'.$viewLink.'" class="event-img" style="background-image: url('.SITE_URL.$row['thumb'].')"></label>';
                            $leftcontainer.='</div>';
                            $leftcontainer.='<div class="right floating-left">';
                            $leftcontainer.='<a class="event-anchor" href="'.$viewLink.'" class="title">'.$row['title_'.ucfirst($cat_code)].'</a>';
                            $leftcontainer.='<p>'.$row['description_'.ucfirst($cat_code)].'</p>';
                            $leftcontainer.='<a class="floating-right" href="'.$viewLink.'">'.$Lang->ReadMore.'</a>';
                            $leftcontainer.='</div>';
                            $leftcontainer.='</div>';
                            $leftcontainer.='<div class="line floating-left"></div>';
                            $leftcontainer.='<div class="circle floating-left"></div>';
                             $leftcontainer.='</div>';
                            $leftcontainer.='</div>';
                            echo $leftcontainer.'<div class="center-container floating-left"></div>';
                        }else{
                            $rightcontainer.='<div class="right-container floating-left">';
                            $rightcontainer.='<div class="row-container right scound-row reveal-right reveal_visible">';
                            $rightcontainer.='<div class="rectangle floating-right">';
                            $rightcontainer.='<div class="square floating-left">';
                            $rightcontainer.='<a class="event-anchor">';
                            $rightcontainer.='<label>'.date('d',strtotime($row['startdate'])).'</label>';
                            $rightcontainer.='<span>'.date('M',strtotime($row['startdate'])).'</span>';
                            $rightcontainer.='</a>';
                            $rightcontainer.='<a href="'.$viewLink.'" class="event-img" style="background-image: url('.SITE_URL.$row['thumb'].')"></label>';
                            $rightcontainer.='</div>';
                            $rightcontainer.='<div class="right floating-left">';
                            $rightcontainer.='<a class="event-anchor" href="'.$viewLink.'" class="title">'.$row['title_'.ucfirst($cat_code)].'</a>';
                            $rightcontainer.='<p>'.$row['description_'.ucfirst($cat_code)].'</p>';
                            $rightcontainer.='<a class="floating-right" href="'.$viewLink.'">...'.$Lang->ReadMore.'</a>';
                            $rightcontainer.='</div>';
                            $rightcontainer.='</div>';
                            $rightcontainer.='<div class="line floating-right"></div>';
                            $rightcontainer.='<div class="circle floating-right"></div>';
                            $rightcontainer.='</div>';
                            $rightcontainer.='</div>';
                            echo $rightcontainer.' </div>';;
                        }
                        $i++;
                    }
                }
                ?>
        </div>
        </div>
    </div>
</div>
</form>
<?php include("includes/footer.php"); ?>
