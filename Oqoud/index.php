<?php
/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 15/06/2020
 * Time: 03:34 م
 */
$currentTab = "Home";
include_once "includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-7">
                        <h5 class="card-title text-left"><?= $prosses->lang('home'); ?></h5>
                    </div>
                    <div class="col-lg-5">
                        <div class="col-lg-9 float-left">
                            <div class="position-relative form-group top-container">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="Category"
                                               class="float-left"><?= $prosses->lang('categories'); ?></label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="Category" id="Category" class="form-control">

                                            <?php
                                            echo '<option  value="-1">----</option>';
                                            $Category = json_decode($prosses->GetCategory(), true);
                                            if (is_array($Category) || is_object($Category)) {
                                                foreach ($Category['data'] as $key => $value) {
                                                    $selected = '';
                                                    if ($prosses->GetIdCategory() == $value['id']) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option ' . $selected . ' value="' . $value['id'] . '">' . $value['name_' . $prosses->Sessionlang()] . '</option>';
                                                }
                                            }

                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($prosses->CanEdit()) {
                        ?>
                        <div class="col-lg-3 float-left">
                            <div class="d-inline-block dropdown float-right">

                                    <a href="editindex.php?id=new"
                                       class="mb-2 btn btn-primary float-right icon-with-color"
                                       title="<?= $prosses->lang('add'); ?>">
                                        <span class="btn-icon-wrapper pr-2"><i id="addcontract"
                                                                               class="metismenu-icon pe-7s-plus"></i></span><?= $prosses->lang('add'); ?>
                                    </a>

                            </div>
                        </div>  <?php
                                }
                                ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?= $prosses->lang('contract_number'); ?></th>
                            <th><?= $prosses->lang('customer_activity'); ?></th>
                            <th><?= $prosses->lang('name'); ?></th>
                            <th><?= $prosses->lang('contract_type'); ?></th>
                            <th><?= $prosses->lang('state'); ?></th>
                            <th><?= $prosses->lang('contract_duration'); ?></th>
                            <th><?= $prosses->lang('start_date'); ?></th>
                            <th><?= $prosses->lang('end_date'); ?></th>
                            <?php
                            echo '<th>' . $prosses->lang('actions') . '</th>';
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $keyword = '';
                        if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
                            $keyword = $_GET['keyword'];
                        }
                        $type = 0;
                        $d_contract = '';
                        $status = 0;
                        $action = 0;
                        $category = $prosses->GetIdCategory();
                        $page = 0;
                        $Page_num = 0;
                        $Oqouds = json_decode($prosses->GetOqoud($keyword, $type, $d_contract, $status, $action, $prosses->GetIdCategory(), $prosses->GetPage()), true);
                        if (is_array($Oqouds) || is_object($Oqouds)) {
                            if ($Oqouds['result'] == '1') {
                                $Page_num = $Oqouds['number'];
                                $i = 1;
                                foreach ($Oqouds['data'] as $key => $value) {
                                    echo ' 
                            <tr>
                                <th scope="row">' . $i . '</th>
                                <td>' . $value['num'] . '</td>
                                <td>' . $value['activity'] . '</td>
                                <td>' . $value['name'] . '</td>
                                <td>' . $value['type'] . '</td>
                                <td>' . $value['status'] . '</td>
                                <td>' . $value['d_contract'] . '</td>
                                <td>' . $value['s_date'] . '</td>
                                <td>' . $value['e_date'] . '</td>
                                <td><a class="icons-actions edit-row" href="editindex.php?id=' . $value['id'] . '" title="' . $prosses->lang('edit') . '"><i class="metismenu-icon pe-7s-pen"></i></a>';
                                    if ($prosses->CanEdit()) {
                                        echo ' <a class="icons-actions delete-row delete-contract" att="' . $value['id'] . '" title="' . $prosses->lang('delete') . '"><i class="metismenu-icon pe-7s-trash"></i></a>';
                                    }
                                    echo '</td></tr>';
                                    $i++;
                                }
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
                    <?= $prosses->Pagination($Page_num) ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>




