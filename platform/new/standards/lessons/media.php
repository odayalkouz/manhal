<?php
$currentTab = "Lessons";
$drow_popup_contents=true;
include_once "../../includes/header.php";
?>

<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg float-right m-b-10">
                        <h5 class="card-title text-left"><?=$Lang->media;?></h5>
                    </div>
                    <div class="col-lg float-right m-b-10">
                        <div class="d-inline-block dropdown float-right">
                            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i id="add" class="metismenu-icon pe-7s-plus"></i><?=$Lang->Add;?></button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-row row">
                        <div class="col-md-3">
                            <div class="media-items-sortable-container" id="sortable">
                                <div class="card-shadow-focus border card card-body border-light item-container-a active" data-src="https://www.manhal.com/en/story/2848/Educational-Cards---The-Prophet’s-PPBUH-Job-(Ar-+-En)">
                                    <img src="https://www.manhal.com/platform/stories/2848/images/pic.jpg" alt="media" class="responsive-center mb-2">
                                    <h6 title="Media Title">Media Title</h6>
                                    <a class="delete floating-right" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="sorting floating-right" title="<?=$Lang->SortBy;?>"><i>↕</i></a>
                                </div>
                                <div class="card-shadow-focus border card card-body border-light item-container-a" data-src="https://www.manhal.com/platform/media/14325/353a2667f0d90043c8e345d14057a215.html">
                                    <img src="https://www.manhal.com/platform/media/14325/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                                    <h6 title="Media Title">Media Title</h6>
                                    <a class="delete floating-right" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="sorting floating-right" title="<?=$Lang->SortBy;?>"><i>↕</i></a>
                                </div>
                                <div class="card-shadow-focus border card card-body border-light item-container-a" data-src="https://www.manhal.com/en/story/2848/Educational-Cards---The-Prophet’s-PPBUH-Job-(Ar-+-En)">
                                    <img src="https://www.manhal.com/platform/stories/2848/images/pic.jpg" alt="media" class="responsive-center mb-2">
                                    <h6 title="Media Title">Media Title</h6>
                                    <a class="delete floating-right" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="sorting floating-right" title="<?=$Lang->SortBy;?>"><i>↕</i></a>
                                </div>
                                <div class="card-shadow-focus border card card-body border-light item-container-a" data-src="https://www.manhal.com/platform/media/14325/353a2667f0d90043c8e345d14057a215.html">
                                    <img src="https://www.manhal.com/platform/media/14325/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                                    <h6 title="Media Title">Media Title</h6>
                                    <a class="delete floating-right" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="sorting floating-right" title="<?=$Lang->SortBy;?>"><i>↕</i></a>
                                </div>
                                <div class="card-shadow-focus border card card-body border-light item-container-a" data-src="https://www.manhal.com/en/story/2848/Educational-Cards---The-Prophet’s-PPBUH-Job-(Ar-+-En)">
                                    <img src="https://www.manhal.com/platform/stories/2848/images/pic.jpg" alt="media" class="responsive-center mb-2">
                                    <h6 title="Media Title">Media Title</h6>
                                    <a class="delete floating-right" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="sorting floating-right" title="<?=$Lang->SortBy;?>"><i>↕</i></a>
                                </div>
                                <div class="card-shadow-focus border card card-body border-light item-container-a" data-src="https://www.manhal.com/platform/media/14325/353a2667f0d90043c8e345d14057a215.html">
                                    <img src="https://www.manhal.com/platform/media/14325/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                                    <h6 title="Media Title">Media Title</h6>
                                    <a class="delete floating-right" title="<?=$Lang->Delete;?>"><i class="metismenu-icon pe-7s-trash"></i></a>
                                    <a class="sorting floating-right" title="<?=$Lang->SortBy;?>"><i>↕</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <iframe allowfullscreen="" frameborder="none" class="iframe-media-container" width="100%" height="100%" scrolling="no" src="https://www.manhal.com/platform/media/6706/525b2f276dcfa022e71aed70dea805cf.html?scorm=true&origin=https://imanhal.manhal.com/"></iframe>
                        </div>
                        <div class="col-md-12">
                            <button class="mt-2 btn btn-primary float-right"><?=$Lang->Save;?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var scroll = '';
        var $scrollable = $("#sortable");
        function scrolling(){
            if (scroll == 'up') {
                $scrollable.scrollTop($scrollable.scrollTop()-20);
                setTimeout(scrolling,50);
            }
            else if (scroll == 'down'){
                $scrollable.scrollTop($scrollable.scrollTop()+20);
                setTimeout(scrolling,50);
            }
        }
        $("#sortable").sortable({
            scroll:false,
            out: function( event, ui ) {
                if (!ui.helper) return;
                if (ui.offset.top>0) {
                    scroll='down';
                } else {
                    scroll='up';
                }
                scrolling();
            },
            over: function( event, ui ) {
                scroll='';
            },
            deactivate:function( event, ui ) {
                scroll='';
            }
        });
        $( "#sortable").disableSelection();
    });
</script>

<?php
include_once "../../includes/footer.php";
?>
