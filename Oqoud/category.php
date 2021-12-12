
<?php
/**
 * Created by PhpStorm.
 * User: oday
 * Date: 18/06/2020
 * Time: 01:34 م
 */
$currentTab="Categories";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}

include_once "function.php";
include_once "includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title text-left"><?=$prosses->lang('categories');?></h5>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        if ($prosses->CanEdit()) {
                            ?>
                            <div class="d-inline-block dropdown float-right">
                                <a href="editcategory.php?id=new"
                                   class="mb-2 btn btn-primary float-right icon-with-color"
                                   title="<?= $prosses->lang('add'); ?>">
                                    <span class="btn-icon-wrapper pr-2 opacity-7"><i
                                                class="metismenu-icon pe-7s-plus"></i></span><?= $prosses->lang('add'); ?>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$prosses->lang('Category_Ar');?></th>
                            <th><?=$prosses->lang('Category_En');?></th>
                            <?php
                            if ($prosses->CanEdit()) {
                                ?>
                                <th><?= $prosses->lang('actions'); ?></th>
                                <?php
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $Category= json_decode($prosses->GetCategory(),true);
                        if (is_array($Category) || is_object($Category))
                        {
                            $i=1;
                            foreach($Category['data'] as $key => $value )
                            {
                                echo'  <tr>
                                          <th scope="row">'.$i.'</th>
                                          <td>'.$value['name_ar'].'</td>
                                          <td>'.$value['name_en'].'</td>';
                                if ($prosses->CanEdit()) {
                                    echo '  <td>
                                              <a class="icons-actions edit-row" href="editcategory.php?id=' . $value['id'] . '" title="' . $prosses->lang('edit') . '"><i class="metismenu-icon pe-7s-pen"></i></a>
                                              <a class="icons-actions delete-row delete-cate" att="' . $value['id'] . '" title="' . $prosses->lang('delete') . '"><i class="metismenu-icon pe-7s-trash"></i></a>
                                          </td>';
                                }
                                    echo' </tr>';
                                $i++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center d-inline-block m-auto">
            <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                <ul class="pagination">

                </ul>
            </nav>

        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>




