<?php
//error_reporting(0);

class action
{
    /**
     * @url GET /category
     */
    public function category($type)
    {
        global $con;
        $this->conn = $con;
        switch ($type) {
            case 'media':
            case 'books':
                $tabel = 'categories';
                break;
            case 'story':
                $tabel = 'stories_cat';
                break;
            default:
                return Array('error' => 'Type error');
        }
        $sql = "Select `catid`,`name_ar`,`name_en` From  " . $tabel . " WHERE `parent`=0";
        $result = $this->conn->query($sql);
        return $result;
    }
    /**
     * @url POST /media
     * @url GET /media
     */
    public function CheckMedia($type = '', $keyword = '', $category = 0, $from = '', $to = '', $series = 0, $storytype = '', $lang = '', $booktype = '', $id = '', $userid = '', $grade='')
    {

        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        if ($id != '') {
            $id = (int)$id;
        }
        switch ($type) {
            case 'books':
                if ($id != '') {
                    return $this->getBookDetails($id, $userid);
                } else {
                    return $this->getbook($keyword, $category, $FromTo, $lang, $booktype,$grade);
                }
                break;
            case 'stories':
                if ($id != '') {
                    return $this->getStoryDetails($id, $userid);
                } else {
                    return $this->getstory($keyword, $category, $FromTo, $series,'',$grade);
                }
                break;
            case 'worksheet':
            case 'interactive-worksheets':
            case 'games':
            case 'video':
            case 'sound':
                if ($id != '') {
                    return $this->getMediaDetails($id, $this->GetTypeMediaID($type), $userid);
                } else {

                    return $this->getmedia($this->GetTypeMediaID($type), $keyword, $category, $FromTo,$grade);
                }
                break;

        }
    }
    /**
     * @url POST /unitslesson
     * @url GET /unitslesson
     */
    public function UnitsLessons($type='',$id=''){
        global $con;
        $this->conn = $con;
        if ($id != '') {
            $id = (int)$id;
        }else{
            return 'error id book';
        }
        switch ($type) {
            case 'unit':
                $type=" and `type`='unit'";
                break;
                case 'lesson':
                    $type=" and `type`='lesson'";
                break;
            default:
                $type="";
                break;
        }
        $sql = "SELECT * FROM `units_lessons` WHERE `bookid`=".$id.$type;
        $result = $this->conn->query($sql);
        return $result;
    }


    /**
     * @url GET /allmedia
     */
    public function AllMedia($from = '', $to = '', $no = 0)
    {
        $filter = 'recent';
        $data_array = [];
        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        $data_array['books'] = $this->FilterBooks($filter, $FromTo, 0);
        $data_array['stories'] = $this->FilterStories($filter, $FromTo, 0);
        $data_array['worksheet'] = $this->FilterMedia($filter, $FromTo, 0, 0);
        $data_array['interactive-worksheets'] = $this->FilterMedia($filter, $FromTo, 0, 0);
        $data_array['games'] = $this->FilterMedia($filter, $FromTo, 11, 0);
        $data_array['video'] = $this->FilterMedia($filter, $FromTo, 4, 0);
        $data_array['sound'] = $this->FilterMedia($filter, $FromTo, 3, 0);
        return $data_array;
    }
    private function FilterStories($filter, $FromTo, $No)
    {
        global $con;
        $this->conn = $con;
        $this->book_type = 'electronic';
        switch ($this->book_type) {
            case "electronic":
                $type_filter = " AND `story`.`type` in(2,3,6,7)";
                break;
            case "interactive":
                $type_filter = " AND `story`.`type` in(4,5,6,7)";
                break;
            case "paper";
                $type_filter = " AND `story`.`type` in(1,3,5,7)";
                break;
            default :
                $type_filter = " AND `story`.`type` in(1,3,5,7)";
                break;
        }
        $story = "(story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view,`story`.description_ar,`story`.description_en";
        switch ($filter) {
            case 'toprated':
                $sql = "Select  " . $story . " From   `story`  INNER JOIN   stories_cat categories1 On story.catid = categories1.catid WHERE story.status=1 " . $type_filter . " Group By   story.storyid Order By   story.rate Desc   " . $FromTo;
                break;
            case 'mostviewed':
                $sql = "Select  " . $story . " From  story story Inner Join   stories_cat categories1 On story.catid = categories1.catid WHERE story.status=1  " . $type_filter . " Group By   story.view_count Order By   view_count Desc  " . $FromTo;
                break;
            case 'recent':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1 " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case "bestseller":
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1 " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case "topfavorite":
                $sql = "Select " . $story . " From   `story`  INNER JOIN   stories_cat categories1 On story.catid = categories1.catid  WHERE story.status=1 " . $type_filter . " Group By   story.storyid Order By   story.favorite_count Desc   " . $FromTo;
                break;
            case 'ar':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1  And `story`.`language`='Ar' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case 'en':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1  And `story`.`language`='En' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case 'categories':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1   AND `story`.`catid` ='" . $No . "' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            default:
                return 'error';
                break;
        }
        $result = $this->conn->query($sql);
        return $result;
    }
    private function FilterBooks($filter, $FromTo, $No)
    {
        global $con;
        $this->conn = $con;
        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en,`books`.price,`books`.`rating_count` as rate,`books`.`views`,`books`.description_ar,`books`.description_en";
        switch ($filter) {
            case 'toprated':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`rate` DESC " . $FromTo;
                break;
            case 'mostviewed':
                $sql = "SELECT " . $books . ", `books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`views` DESC " . $FromTo;
                break;
            case 'recent':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            case "bestseller":
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`sales` DESC " . $FromTo;
                break;
            case "topfavorite":
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`favorites` DESC " . $FromTo;
                break;
            case 'ar':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1 And `books`.`language`='Ar'  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            case 'en':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1 And `books`.`language`='En'  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            case 'categories':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1 And `books`.`category`='" . $No . "'  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            default:
                return 'error';
                break;
        }

        $result = $this->conn->query($sql);
        return $result;
    }
    private function FilterMedia($filter, $FromTo, $typesmedia, $No)
    {
        global $con;
        $this->conn = $con;
        $Media = "media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,media.filename,media.price,media.rate,media.title_ar,media.title_en,media.views,media.path,`media`.description_ar,`media`.description_en";
        switch ($filter) {
            case 'toprated':
                $sql = "Select " . $Media . "  From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`rate` DESC" . $FromTo;
                break;
            case 'mostviewed':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`views` DESC" . $FromTo;
                break;
            case 'recent':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            case "bestseller":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`sales` DESC" . $FromTo;
                break;
            case "topfavorite":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`favorites` DESC" . $FromTo;
                break;
            case "ar":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.language='Ar' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            case "en":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.language='En' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            case 'categories':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.category='" . $No . "' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            default:
                return 'error';
                break;
        }
        $result = $this->conn->query($sql);
        return $result;
    }
    private function getmedia($typesmedia, $keyword, $category, $FromTo, $search = '',$grade)
    {

        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->grade = '';
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
            } else {
                $this->keyword = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
            }
        }
        if ($category != 0) {
            $this->category = " AND `category` = " . $category;
        }
        if ($grade != '') {
            $this->grade = " AND media.`grade` = " . $grade;
        }
        $sql = "Select media.type,media.filename,media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,media.title_ar,media.title_en,media.path From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . $this->keyword . $this->category.$this->grade . " " . " ORDER BY `media`.`price` ASC,`media`.`id` DESC " . $this->FromTo;
        $result = $this->conn->query($sql);
       // return $sql;
return $result;
    }
    private function getbook($keyword, $category, $FromTo, $lang, $booktype, $search = '')
    {
        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->lang = '';
        $this->grade='';
        $this->type = $this->gettypeBookAndStory($booktype, 'books');
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND ( `name` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
                // $this->keyword = " AND ( `name` MATCH" . mysqli_real_escape_string($this->conn, $keyword) . "'  )";

            } else if ($search == '') {
                $this->keyword = " AND ( `name` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' )";
            }

        }
        if ($category != 0) {
            $this->category = " AND `category` = " . $category;
        }
        if ($grade != '') {
            $this->grade = " AND `grade` = " . $grade;
        }
        if ($lang != '') {
            $this->lang = "AND `books`.`language`='" . $lang . "'";
        }

        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en";
        $sql = "SELECT " . $books . " FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1  AND( `books`.`bookid`>0 " . $this->keyword . $this->category . $this->lang . $this->type . $this->grade . " ) " . " ORDER BY `books`.`booktype` DESC,`books`.`name` DESC " . $this->FromTo;
        $result = $this->conn->query($sql);
        return $result;
    }
    private function getstory($keyword,$category,$FromTo,$series, $search = '',$grade)
    {
        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->series_filter_stories = '';
        $this->grade = '';
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
            } else {
                $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
            }

        }
        if ($category != 0) {
            $this->category = " AND `category` = " . $category;
        }
        if ($series > 0) {
            $this->series_filter_stories = " AND `series`.`seriesid` = " . $series;
        }

        if ($grade != '' ) {
            $this->grade = " AND story.`age` = " . $grade;
        }
        $type_filter = " AND `story`.`type` in(2,3,6,7)";

        $sql = "SELECT (story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,story.title as title_ar,story.title as title_en    FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE `story`.`status`=1  AND( `story`.`storyid`>0 " . $this->keyword . $this->category . $this->series_filter_stories . $this->type . $type_filter.$this->grade . " ) " . $this->FromTo;
        $result = $this->conn->query($sql);
        return $result;
    }
    private function gettypeBookAndStory($type, $typemedia)
    {


        $this->type = '';
        if ($typemedia == 'books') {
            $this->sqtype = 'booktype';
        } else if ($typemedia == 'story') {
            $this->sqtype = 'type';
        }
        switch ($type) {
            case "electronic":
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(2,3,6,7)";
                break;
            case "interactive":
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(4,5,6,7)";
                break;
            case "paper";
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(1,3,5,7)";
                break;
            default :
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(1,3,5,7)";
                break;
        }
        return $this->type;
    }
    private function GetTypeMediaID($type)
    {
        $typemedia = '';
        switch ($type) {
            case 'worksheet':
                $typemedia = 0;
                break;
            case 'interactive-worksheets':
                $typemedia = 12;
                break;

            case 'sound':
                $typemedia = 3;
                break;
            case 'video':
                $typemedia = 4;
                break;
            case 'games':
                $typemedia = 11;
                break;
        }
        return $typemedia;
    }
}
include_once('../../platform/config.php');
require_once 'vendor/restler.php';
use Luracast\Restler\Restler;
$restler = new Restler();
$restler->setSupportedFormats('JsonFormat');
$restler->addAPIClass('action');
$restler->handle();
header("Content-Type: text/html; charset=utf-8");
