<?php
$currentTab="aboutus";
include_once "includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/sitemap.css<?=$cash;?>">
<div class="inner-pages-main-container-sitemap">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <section class="row">
                        <div class="tree">
                            <ul>
                                <li>
                                    <i class="fa fa-folder-open-o"></i><a href="<?= SITE_URL . $lang_code; ?>/" class="node"><?=$Lang->Home;?></a>
                                    <ul>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/books"><?=$Lang->Books;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/stories"><?=$Lang->Stories;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/check-out"><?=$Lang->Cart;?></a></li>
                                        <li class="marg">
                                            <i class="fa fa-folder-o folder"></i><i class="fa fa-plus-circle"></i>
                                            <a class="open"><?=$Lang->Editors;?></a>
                                            <ul style="display: none">
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/books-editor"><?= $Lang->bookEditor; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/stories-editors"><?= $Lang->storyEditor; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/quiz-editor"><?= $Lang->QuizEditor; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/interactive-stories-editors"><?= $Lang->InteractiveStoriesBuilder; ?></a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/features"><?=$Lang->Features;?></a></li>
                                        <li class="marg">
                                            <i class="fa fa-folder-o folder"></i><i class="fa fa-plus-circle"></i>
                                            <a class="open"><?=$Lang->Products;?></a>
                                            <ul style="display: none">
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/products"><?= $Lang->All; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/books"><?= $Lang->Books; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/electronic-books"><?= $Lang->ebooks; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/electronic-books"><?= $Lang->InteractiveBooks; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/stories"><?= $Lang->Stories;?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/electronic-stories"><?= $Lang->EStories; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/electronic-stories"><?= $Lang->InteractiveStories; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/games"><?= $Lang->EducationalGames; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/educational-tools-info"><?= $Lang->EducationalTools; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/applications"><?= $Lang->Application; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/furniture"><?= $Lang->Furniture; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/worksheet"><?= $Lang->worksheets; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/interactive-worksheets"><?= $Lang->InteractiveWorksheets; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/audio"><?= $Lang->Sounds; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/video"><?= $Lang->Videos; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/teachers-guides"><?= $Lang->TeachersGuides; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/quizzes"><?= $Lang->Quizzes; ?></a>
                                                </li>
                                                <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/worksheet/category/11/coloring?category=11"><?= $Lang->ColoringWorksheet; ?></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/Subscribe"><?=$Lang->Subscribe;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/services"><?=$Lang->Services;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/our-partners"><?=$Lang->Partners;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/make-money-online"><?=$Lang->MakeMony;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a class="feedbacksitemap"><?=$Lang->Feedback;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/games"><?=$Lang->Games;?></a></li>
                                        <?php
                                        if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                            ?>
                                            <li class="marg">
                                                <i class="fa fa-folder-o folder"></i><i class="fa fa-plus-circle"></i><a
                                                    class="open"><?= $Lang->User; ?></a></a>
                                                <ul style="display: none">
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/favorites"><?= $Lang->Favorites; ?></a>
                                                    </li>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/purchased"><?= $Lang->Purchased; ?></a>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/orders"><?= $Lang->orders; ?></a>
                                                    </li>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                                href="<?= SITE_URL . $lang_code ?>/myquizzes"><?= $Lang->myquizzes; ?></a>
                                                    </li>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/activation"><?= $Lang->Activation; ?></a>
                                                    </li>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/edit-profile"><?= $Lang->EditProfile; ?></a>
                                                    </li>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/membership"><?= $Lang->subscription; ?></a>
                                                    </li>
                                                    <li><i class="fa fa-file-text-o"></i><a
                                                            href="<?= SITE_URL . $lang_code ?>/change-password"><?= $Lang->ChangePassword; ?></a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/contact-us"><?=$Lang->contactusTitle;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/about-us"><?=$Lang->AboutUs;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/Subscribe"><?=$Lang->Subscribe;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/applications"><?=$Lang->Application;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/careers"><?=$Lang->careers;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/sitemap"><?=$Lang->Sitemap;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/privacy-policy"><?=$Lang->privacyPolicy;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/terms-and-conditions"><?=$Lang->TermsConditions;?></a></li>
                                        <li><i class="fa fa-file-text-o"></i><a href="<?=SITE_URL.$lang_code?>/faq"><?=$Lang->FAQ;?></a></li>
                                        <li class="marg">
                                            <i class="fa fa-folder-o folder"></i><i class="fa fa-plus-circle"></i><a class="open"><?=$Lang->FOLLOWUS;?></a>
                                            <ul style="display: none">
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://www.facebook.com/daralmanhalpublishers/"><?=$Lang->Facebook;?></a> </li>
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://twitter.com/dar_manhal"><?=$Lang->Twitter;?></a> </li>
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://www.linkedin.com/in/dar-almanhal-5016ba113?trk=hp-identity-name"><?=$Lang->LinkedIn;?></a> </li>
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://plus.google.com/112142188100849560488"><?=$Lang->Googleplus;?></a> </li>
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://www.pinterest.com/daralmanhal"><?=$Lang->Pinterest;?></a> </li>
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://www.flickr.com/photos/138422983@N05/"><?=$Lang->Flickr;?></a> </li>
                                                <li><i class="fa fa-file-text-o"></i><a target="_blank" href="https://vimeo.com/user50812788"><?=$Lang->Vimeo;?></a></li>
                                                <li><i class="fa fa-file-text-o"></i><a  target="_blank" href="https://www.youtube.com/channel/UCHQkQ8ZFdArwWFRE8hmQ6Bg"><?=$Lang->Youtube;?></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>

