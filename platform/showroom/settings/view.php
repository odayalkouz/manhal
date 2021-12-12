<?php
include_once '../includes/functions.php';
?>

<div id="carouselExampleControls1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
       <?php echo $prosses->GetViewSliders() ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
