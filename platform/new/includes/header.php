<?php
if(session_status()===PHP_SESSION_NONE){
    session_start();
}
    $server_root=$_SERVER['DOCUMENT_ROOT']."/manhal/";
    include_once($server_root.'platform/config.php');
    include_once $server_root."platform/new/includes/db.php";
    include_once $server_root."platform/new/includes/functions.php";
    $URL="http://localhost/Manhal/platform/new";
    $real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=""){
        $db_lang=strtolower($_SESSION["lang"]);
        $Lang = simplexml_load_file($server_root."language/".ucfirst($_SESSION["lang"]).".xml");
    }else{
        $db_lang="en";
        $_SESSION["lang"]="en";
        $Lang = simplexml_load_file($server_root."language/En.xml");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Dar Al-Manhal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="Contracts">
    <meta name="msapplication-tap-highlight" content="no">
    <link data-type="favicon" href="<?=$URL;?>/themes/all/images/favicon.ico" type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="<?=$URL;?>/themes/en/css/main.css">
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/lobibox.min.css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/dataTables.bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/bootstrap-multiselect.css" type="text/css"/>
    <script type="text/javascript" src="<?=$URL;?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/library.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/lobibox.min.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/manhal-ui.js"></script>
    <script type="text/javascript" src="<?=$URL;?>/js/standards.js"></script>
</head>
<body>
<?php
if(isset($drow_popup_contents) &&  $drow_popup_contents== true)
{
?>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLongTitle"><?=$Lang->Addmedia;?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3 float-left">
                        <div class="position-relative form-group top-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="Category" class="float-left"><?=$Lang->search;?></label>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 float-left">
                        <div class="position-relative form-group top-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="Category" class="float-left"><?=$Lang->Grades;?></label>
                                </div>
                                <div class="col-lg-9">
                                    <select name="Grades" id="Grades" class="form-control change_submit">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 float-left">
                        <div class="position-relative form-group top-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="Category" class="float-left"><?=$Lang->Subject;?></label>
                                </div>
                                <div class="col-lg-9">
                                    <select name="Subjects" id="Subjects" class="form-control change_submit">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 float-left">
                        <div class="position-relative form-group top-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="Category" class="float-left"><?=$Lang->Option;?></label>
                                </div>
                                <div class="col-lg-9">
                                    <select name="type" id="type" class="form-control change_submit">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="media-items-sortable-container popup">
                  <div class="row">
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a ">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="card-shadow-focus border card card-body border-light item-container-a">
                              <img src="https://www.manhal.com/platform/media/7714/thumbnail_small.jpg" alt="media" class="responsive-center mb-2">
                              <h6 title="Media Title">Media Title Media Title Media Title Media Title</h6>
                              <div class="btn-group add">
                                  <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn  floating-right">
                                      <i class="metismenu-icon pe-7s-plus"></i>
                                  </a>
                                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left">
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                      <a title="Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes" class="dropdown-item">Outcomes Outcomes Outcomes Outcomes Outcomes Outcomes </a>
                                  </div>
                              </div>
                              <a class="" title="<?=$Lang->Add;?>"></a>
                              <a class="view floating-right" title="<?=$Lang->View;?>"><i class="metismenu-icon pe-7s-look"></i></a>
                          </div>
                      </div>
                </div>
              </div>
                <div class="row">
                    <div class="text-center d-inline-block m-auto">
                        <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a href="javascript:GotoPage(0);" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only"><?=$Lang->GotoPreviousPage;?></span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a href="javascript:GotoPage(0);" class="page-link">1</a>
                                </li>
                                <li class="page-item">
                                    <a href="javascript:GotoPage(0);" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="javascript:GotoPage(0);" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="javascript:GotoPage(0);" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only"><?=$Lang->GotoNextPage;?></span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    <?php
}
?>
<div class="loader-main-container">
    <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
        <circle cx="170" cy="170" r="160" stroke="#00ad68"/>
        <circle cx="170" cy="170" r="135" stroke="#ffffff"/>
        <circle cx="170" cy="170" r="110" stroke="#00ad68"/>
        <circle cx="170" cy="170" r="85" stroke="#ffffff"/>
    </svg>
</div>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <a href="index.php" class="logo-src"></a>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">
                <div class="search-wrapper">
                    <div class="input-holder">
                        <input type="text" class="search-input" id="header_keyword" placeholder="search" value="<?php if(isset($_GET["search"]) && $_GET["search"]!=""){echo $_GET["search"];}?>">
                        <button class="search-icon" id="header_search"><span></span></button>
                    </div>
                    <button class="close"></button>
                </div>
                <ul class="header-menu nav" style="display: none">
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon fa fa-database"> </i>page1</a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon fa fa-edit"></i>page2</a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon fa fa-cog"></i>page3</a>
                    </li>
                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group pr-2 pl-2">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="25" class="rounded-circle" src="<?=$URL;?>/themes/en/images/login.svg" alt="">
                                        khalid alomiri
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <a type="button" tabindex="0" class="dropdown-item" href="<?=$URL;?>/profile.php">Edit Profile</a>
                                        <div tabindex="-1" class="dropdown-divider"></div>
<!--                                        <a type="button" tabindex="0" class="dropdown-item" href="privacypolicy.php">Privacy Policy</a>-->
<!--                                        <div tabindex="-1" class="dropdown-divider"></div>-->
<!--                                        <a type="button" tabindex="0" class="dropdown-item" href="termsconditions.php">Terms &amp; Conditions</a>-->
<!--                                        <div tabindex="-1" class="dropdown-divider"></div>-->
                                        <form method="get" action="api.php" target="_self">
                                            <input type="hidden" name="process" value="logout">
                                            <input class="dropdown-item" type="submit" value="Sign Out">
                                        </form>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="25" class="rounded-circle" src="<?=$URL;?>/themes/all/images/language.svg" alt="">
                                        En
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <a type="button" tabindex="0" class="dropdown-item" href="">Arabic</a>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                        <span>
                            <button type="button"
                                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading"><?=$Lang->Standards;?></li>
                        <li>
                            <a class="<?php if ($currentTab == "allignedstandard") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/allignedstandard/index.php">
                                <i class="metismenu-icon pe-7s-graph3"></i>
                                <?=$Lang->Alignedstandards;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Domains") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/Domains/index.php">
                                <i class="metismenu-icon pe-7s-global"></i>
                                <?=$Lang->Domains;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Pivots") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/pivots/index.php">
                                <i class="metismenu-icon pe-7s-shuffle"></i>
                                <?=$Lang->Pivots;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Standards") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/Standards/index.php">
                                <i class="metismenu-icon pe-7s-map"></i>
                                <?=$Lang->Standards;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Outcomes") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/Outcomes/index.php">
                                <i class="metismenu-icon pe-7s-display2"></i>
                                <?=$Lang->Outcomes;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Courses") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/Courses/index.php">
                                <i class="metismenu-icon pe-7s-wallet"></i>
                                <?=$Lang->Courses;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Units") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/Units/index.php">
                                <i class="metismenu-icon pe-7s-network"></i>
                                <?=$Lang->Units;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Lessons") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/lessons/index.php">
                                <i class="metismenu-icon pe-7s-photo-gallery"></i>
                                <?=$Lang->lessons;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Grades") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/standards/grades/index.php">
                                <i class="metismenu-icon pe-7s-graph1"></i>
                                <?=$Lang->Grades;?>
                            </a>
                        </li>
                        <li class="bs-example">
                            <button id="basicInfoAnimation" class="btn btn-info">Info message</button>
                            <button id="basicWarningAnimation" class="btn btn-warning">Warning message</button>
                            <button id="basicErrorAnimation" class="btn btn-danger">Error message</button>
                            <button id="basicSuccessAnimation" class="btn btn-success">Success message</button>
                            <button id="confirmAnimation" class="btn btn-circle">Confirm message</button>
                        </li>
                        <li class="app-sidebar__heading"><?=$Lang->Store;?></li>
                        <li>
                            <a class="<?php if ($currentTab == "Store") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/store/index.php">
                                <i class="metismenu-icon pe-7s-server"></i>
                                <?=$Lang->Store;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Department") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/store/department/index.php">
                                <i class="metismenu-icon pe-7s-vector"></i>
                                <?=$Lang->Department;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Report") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/store/report/index.php">
                                <i class="metismenu-icon pe-7s-vector"></i>
                                <?=$Lang->Report;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Category") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/store/category/index.php">
                                <i class="metismenu-icon pe-7s-vector"></i>
                                <?=$Lang->Category;?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Brand") {
                                echo 'mm-active';
                            } ?>" href="<?=$URL;?>/store/brand/index.php">
                                <i class="metismenu-icon pe-7s-vector"></i>
                                <?=$Lang->brand;?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="app-main__outer">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Link 1</a></li>
                    <li class="breadcrumb-item"><a href="#">Link 2</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Link 3</li>
                </ol>
            </nav>