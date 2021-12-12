<?php
error_reporting(0);
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

class action
{
    /**
     * @url POST /adduser
     */
    public function addUser(){
        global $con;
        $this->conn = $con;

        $sql = "INSERT INTO `users`(`userid`,`uname`,`password`, `email`, `permession`, `cdate`, `status`, `birthdate`, `lms_id`, `lms_userid`, `lms_uname`, `lms_password`) VALUES ('',
'".mysqli_real_escape_string($con,$_POST["lms_uname"])."','".mysqli_real_escape_string($con,$_POST["lms_password"])."','".mysqli_real_escape_string($con,$_POST["email"])."',".$_POST["permission"].",CURDATE(),1,'".$_POST["birthdate"]."',".$_POST["lms_id"].",
".$_POST["lms_userid"].",'".mysqli_real_escape_string($con,$_POST["lms_uname"])."','".mysqli_real_escape_string($con,$_POST["lms_password"])."')";
        if($this->conn->query($sql)){
            $manhal_id= $this->conn->insert_id;
            $result=array("status"=>"ok","manhal_id"=>$manhal_id);
        }else{
            $result=array("status"=>"fail","manhal_id"=>0);
        }
        return $result;
    }

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
            case 'quiz':
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
    public function CheckMedia($type = '',$keyword = "", $category = -1, $from = '', $to = '', $series = 0, $storytype = '', $lang = '', $booktype = '', $id = '', $userid = '', $grade='')
    {

        $FromTo = '';
        if ($to != '' && $to > 0) {
            $to=15;
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
                    return $this->getstory($keyword, $category, $FromTo, $series,'',$grade,$userid);
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
                    return $this->getmedia($this->GetTypeMediaID($type),$keyword, $category, $FromTo,$grade);
                }
                break;
            case 'quiz':
                return $this->getquiz($keyword,$category,$grade,$FromTo);
                break;
            case 'all':
                global $con;
                $this->conn = $con;
                $this->FromTo = $FromTo;
                $this->keyword_Story = '';
                $this->category_Story = '';
                $this->series_filter_stories = '';
                $this->grade_Story = '';
                $this->userfilter = '';
                if ($keyword != "") {
                    $this->keyword_Story = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
                }
                if ($category >0) {
                    $this->category_Story = " AND `story`.`catid` = " . $category;
                }

                if (isset($grade) && $grade > 0) {
                    $this->grade_Story = " AND story.`age` = " . $grade;
                }
                $type_filter_Story = " AND `story`.`type` in(2,3,6,7) AND (`story`.`status`=1 OR `story`.`published`=1) ";



                $this->keyword_media = '';
                $this->category_media = '';
                $this->grade_media = '';


                $typesmedia='>-1';



                if ($keyword != "") {
                    $this->keyword_media = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
                }
                if ($category >0) {
                    $this->category_media = " AND `category` = " . $category;
                }
                if (isset($grade) && $grade > 0) {
                    $this->grade_media = " AND media.`grade` = " . $grade;
                }
                if ($keyword != "") {
                    $keyword_filter_quiz = " AND ( `title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `Introduction` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' ) ";
                }
                if (isset($grade) && $grade > 0) {
                    $age_filter_quiz = " AND `age` = " . $grade;
                }
                $OR="";
                $sql="SELECT `storyid` as id ,`seriesid`,IF(story.storyid>0,'17','17') as type,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`title` as title_ar ,`title` as title_en,`story`.`catid` as category,`type` as is_playlist,`path` as filename,`path`,`stories_cat`.`name_ar` as category_ar ,`stories_cat`.`name_en` as category_en , `story`.`add_date` as created_at  FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid`  WHERE (`story`.`package`=0 AND  (`story`.`status`=1 OR `story`.`published`=1)   AND( `story`.`storyid`>0 " . $this->keyword_Story . $this->category_Story . $this->series_filter_stories_Story . $this->type_Story . $type_filter_Story.$this->grade_Story . " ))  " . $this->FromTo." UNION SELECT `id`,`id` as seriesid,iF(media.is_story=0,iF(media.template>0,12,media.type ),13 )as type,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,`title_ar`,`title_en`,`category`,`is_playlist`,IF(media.filename is null AND media.template is not null,'index',media.filename) as filename,`path`,categories.name_ar as category_ar, categories.name_en as category_en , `media`.`cdate` as created_at FROM `media` Inner Join categories On media.category = categories.catid  WHERE media.status = 1 And media.id > 0 And media.type" . $typesmedia . $this->keyword_media . $this->category_media.$this->grade_media . " UNION SELECT `quizid` as id ,`quizid` as seriesid,`quizid` as thumbnail,`title` as title_ar,`title` as title_en,`category`, `quizid` as is_playlist,`quizid` as filename, `quizid` as path,`categories`.`name_ar` as category_ar,`categories`.`name_en` as category_en, IF(quiz.quizid>0,'6','6') as `type` , `quiz`.`cdate` as created_at FROM `quiz` Inner Join `categories` On `quiz`.`category` = `categories`.`catid`  WHERE (`quiz`.`is_public`=1".$OR.") ".$keyword_filter_quiz . $this->category_media .  $age_filter_quiz." GROUP BY id order by id DESC  " . $FromTo;
                $result = $this->conn->query($sql);
                $sql2="SELECT COUNT(*) as counts FROM(SELECT `storyid` as id ,`seriesid`,IF(story.storyid>0,'17','17') as type,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`title` as title_ar ,`title` as title_en,`story`.`catid` as category,`type` as is_playlist,`path` as filename,`path`,`stories_cat`.`name_ar` as category_ar ,`stories_cat`.`name_en` as category_en ,`story`.`add_date` as created_at  FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid`  WHERE (`story`.`package`=0 AND  (`story`.`status`=1 OR `story`.`published`=1)    AND( `story`.`storyid`>0 " . $this->keyword_Story . $this->category_Story . $this->series_filter_stories_Story . $this->type_Story . $type_filter_Story.$this->grade_Story . " ))  " . $this->FromTo." UNION SELECT `id`,`id` as seriesid,`type`,IF(media.path='','http  s://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,`title_ar`,`title_en`,`category`,`is_playlist`,IF(media.filename is null AND media.template is not null,'index',media.filename) as filename,`path`,categories.name_ar as category_ar, categories.name_en as category_en , `media`.`cdate` as created_at FROM   `media` Inner Join categories On media.category = categories.catid  WHERE media.status = 1 And media.id > 0 And media.type" . $typesmedia . $this->keyword_media . $this->category_media.$this->grade_media . " UNION SELECT `quizid` as id ,`quizid` as seriesid,`quizid` as thumbnail,`title` as title_ar,`title` as title_en,`category`, `quizid` as is_playlist,`quizid` as filename, `quizid` as path,`categories`.`name_ar` as category_ar,`categories`.`name_en` as category_en, IF(quiz.quizid>0,'6','6') as `type` ,`quiz`.`cdate` as created_at   FROM `quiz` Inner Join `categories` On `quiz`.`category` = `categories`.`catid`  WHERE (`quiz`.`is_public`=1".$OR.") ".$keyword_filter_quiz . $this->category_media .  $age_filter_quiz." GROUP BY id order by id DESC  ) as counts " ;
                $result2 = $this->conn->query($sql2);
                $array['data']=$result;
                $length=0;
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result2);
                    $length=$row['counts'];
                }
                $array['counts']=$length;
                return $array;
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
                $type_filter = " AND `story`.`type` in(2,3,6,7) AND  (`story`.`status`=1 OR `story`.`published`=1) ";
                break;
            case "interactive":
                $type_filter = " AND `story`.`type` in(4,5,6,7) AND  (`story`.`status`=1 OR `story`.`published`=1)  ";
                break;
            case "paper";
                $type_filter = " AND `story`.`type` in(1,3,5,7) AND  (`story`.`status`=1 OR `story`.`published`=1)  ";
                break;
            default :
                $type_filter = " AND `story`.`type` in(1,3,5,7) AND  (`story`.`status`=1 OR `story`.`published`=1)  ";
                break;
        }
        $story = "(story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view,`story`.description_ar,`story`.description_en,`story`.`catid` as `category`,`story`.`add_date` as created_at";
        switch ($filter) {
            case 'toprated':
                $sql = "Select  " . $story . " From   `story`  INNER JOIN   stories_cat categories1 On story.catid = categories1.catid WHERE  (`story`.`status`=1 OR `story`.`published`=1)  " . $type_filter . " Group By   story.storyid Order By   story.rate Desc   " . $FromTo;
                break;
            case 'mostviewed':
                $sql = "Select  " . $story . " From  story story Inner Join   stories_cat categories1 On story.catid = categories1.catid WHERE  (`story`.`status`=1 OR `story`.`published`=1)   " . $type_filter . " Group By   story.view_count Order By   view_count Desc  " . $FromTo;
                break;
            case 'recent':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE  (`story`.`status`=1 OR `story`.`published`=1)  " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case "bestseller":
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE  (`story`.`status`=1 OR `story`.`published`=1)  " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case "topfavorite":
                $sql = "Select " . $story . " From   `story`  INNER JOIN   stories_cat categories1 On story.catid = categories1.catid  WHERE  (`story`.`status`=1 OR `story`.`published`=1)  " . $type_filter . " Group By   story.storyid Order By   story.favorite_count Desc   " . $FromTo;
                break;
            case 'ar':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE  (`story`.`status`=1 OR `story`.`published`=1)   And `story`.`language`='Ar' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case 'en':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE  (`story`.`status`=1 OR `story`.`published`=1)   And `story`.`language`='En' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case 'categories':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE  (`story`.`status`=1 OR `story`.`published`=1)    AND `story`.`catid` =".$No." ".$type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
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
        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en,`books`.price,`books`.`rating_count` as rate,`books`.`views`,`books`.description_ar,`books`.description_en,`books`.`cdate` as created_at";
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
        $Media = "media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,IF(media.filename is null AND media.template is not null,'index',media.filename) as filename,media.price,media.rate,media.title_ar,media.title_en,media.views,media.path,`media`.description_ar,`media`.description_en,`media`.`cdate` as created_at";
        switch ($filter) {
            case 'toprated':
                $sql = "Select " . $Media . "  From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`rate` DESC" ;
                break;
            case 'mostviewed':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`views` DESC" ;
                break;
            case 'recent':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" ;
                break;
            case "bestseller":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`sales` DESC" ;
                break;
            case "topfavorite":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`favorites` DESC" ;
                break;
            case "ar":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.language='Ar' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC";
                break;
            case "en":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.language='En' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" ;
                break;
            case 'categories':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.category='" . $No . "' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" ;
                break;
            default:
                return 'error';
                break;
        }
        $sql2="SELECT COUNT(*) as counts FROM($sql) as counts " ;
        $sql.=$this->FromTo;
        $result = $this->conn->query($sql);
        $result2 = $this->conn->query($sql2);
        $array['data']=$result;
        $length=0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $length=$row['counts'];
        }
        $array['counts']=$length;
        return $array;

    }
    private function getquiz($keyword,$category,$grade,$FromTo){
        global $con;
        $this->conn = $con;
        $keyword_filter = "";
        $cat_filter = "";
        $age_filter = "";


        if (isset($keyword) && $keyword != "") {
            $keyword_filter = " AND ( `title` LIKE '%" . mysqli_real_escape_string($con, $keyword) . "%' OR `Introduction` LIKE '%" . mysqli_real_escape_string($con, $keyword) . "%' ) ";
        }

        if (isset($category) && $category > 0) {
            $cat_filter = " AND `category` = " . $category;
        }
        if (isset($grade) && $grade > 0) {
            $age_filter = " AND `age` = " . $grade;
        }
        $OR="";
        if(isset($_GET["manhal_id"]) && $_GET["manhal_id"]!=""){
            $OR=" or `quiz`.`userid`=".$_GET["manhal_id"];
        }
        $sql = "SELECT  quiz.*,IF(quiz.quizid>0,'6','6') as `type`,`categories`.`name_ar`,`categories`.`name_en` , `quiz`.`cdate` as  created_at FROM `quiz` Inner Join `categories` On `quiz`.`category` = `categories`.`catid` WHERE (`quiz`.`is_public`=1".$OR.") ".$keyword_filter . $cat_filter .  $age_filter.  "  " ;


        $sql2="SELECT COUNT(*) as counts FROM($sql) as counts " ;
        $sql.=$FromTo;

        $result = $this->conn->query($sql);

        $result2 = $this->conn->query($sql2);
        $array['data']=$result;
        $length=0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $length=$row['counts'];
        }
        $array['counts']=$length;
        return $array;


    }
    private function getmedia($typesmedia, $keyword, $category, $FromTo, $grade)
    {

        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->grade = '';
        if($typesmedia==-1){
            $typesmedia='>'.$typesmedia;

        }else{
            $typesmedia='='.$typesmedia;
        }

        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
            } else {
                $this->keyword = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
            }
        }
        if (isset($category) && $category > 0) {
            $this->category = " AND `category` = " . $category;
        }
        if (isset($grade) && $grade > 0) {
            $this->grade = " AND media.`grade` = " . $grade;
        }
        $sql = "Select media.is_playlist,iF(media.is_story=0,iF(media.template>0,12,media.type ),13 )  as type,IF(media.filename is null AND media.template is not null,'index',media.filename) as filename,media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,media.title_ar,media.title_en,media.path, categories.name_ar as category_ar, categories.name_en as category_en , `media`.`cdate` as created_at From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type" . $typesmedia . $this->keyword . $this->category.$this->grade . " " . " ORDER BY `media`.`price` ASC,`media`.`id` DESC " ;

        $sql2="SELECT COUNT(*) as counts FROM($sql) as counts " ;
        $sql.=$this->FromTo;
        $result = $this->conn->query($sql);
        $result2 = $this->conn->query($sql2);
        $array['data']=$result;
        $length=0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $length=$row['counts'];
        }
        $array['counts']=$length;
        return $array;

        // return $sql;

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
                $this->keyword = " OR ( `name` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' )";
            }

        }
        if ($category > 0) {
            $this->category = " AND `category` = " . $category;
        }
        if (isset($grade) && $grade > 0) {
            $this->grade = " AND `grade` = " . $grade;
        }
        if ($lang != '') {
            $this->lang = "AND `books`.`language`='" . $lang . "'";
        }

        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en ,`books`.`cdate` as created_at";
        $sql = "SELECT " . $books . " FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1  AND( `books`.`bookid`>0 " . $this->keyword . $this->category . $this->lang . $this->type . $this->grade . " ) " . " ORDER BY `books`.`booktype` DESC,`books`.`name` DESC " ;

        $sql2="SELECT COUNT(*) as counts FROM($sql) as counts " ;
        $sql.=$this->FromTo;
        $result = $this->conn->query($sql);
        $result2 = $this->conn->query($sql2);
        $array['data']=$result;
        $length=0;
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $length=$row['counts'];
        }
        $array['counts']=$length;

        return $array;

    }
    private function getstory($keyword,$category,$FromTo,$series, $search = '',$grade,$userid=0)
    {

        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->series_filter_stories = '';
        $this->grade = '';
        $this->userfilter = '';
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
            } else {
                $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
            }

        }
        if ($category >0) {
            $this->category = " AND `story`.`catid` = " . $category;
        }
        if ($series > 0) {
            $this->series_filter_stories = " AND `series`.`seriesid` = " . $series;
        }


        if ($userid != 0 ) {
            $this->userfilter = " OR (  story.`userid` = " . $userid."  AND  (`story`.`status`=1 OR `story`.`published`=1)  ".$this->keyword." )";
        }

        if (isset($grade) && $grade > 0) {
            $this->grade = " AND story.`age` = " . $grade;
        }
        //$type_filter = " AND `story`.`type` in(2,3,6,7) AND `story`.`status`=1";
        $type_filter = " AND `story`.`type` in(2,3)  AND  (`story`.`status`=1 OR `story`.`published`=1) ";


        $sql = "SELECT IF(story.storyid>0,'17','17') as type, (story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,story.title as title_ar,story.title as title_en,story.catid as category ,`stories_cat`.`name_ar` as `category_ar` ,`stories_cat`.`name_en` as `category_en` , `story`.`add_date` as created_at  FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE `story`.`package`=0  AND (`story`.`status`=1 OR `story`.`published`=1)   AND( `story`.`storyid`>0 " . $this->keyword . $this->category . $this->series_filter_stories . $this->type . $type_filter.$this->grade . " ) ".$this->userfilter." " ;

        $sql2="SELECT COUNT(*) as counts FROM($sql) as counts " ;
        $sql.=$this->FromTo;
        $result = $this->conn->query($sql);
        $array['data']=$result;


        $result2 = $this->conn->query($sql2);
        $length=0;
        if (mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $length=$row['counts'];
        }
        $array['counts']=$length;


//        echo $sql;
//        echo "-----------<br>";
//        echo $sql2;
//        exit();
//        return;

        return $array;

        // return $result;


        //$sql = "SELECT (story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view,`story`.description_ar,`story`.description_en   FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE ( `story`.`package`=0)   AND( `story`.`storyid`>0 " . $this->keyword . $this->category . $this->series_filter_stories . $this->type . $type_filter . " ) " . $this->FromTo;
        //$result = $this->conn->query($sql);


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
//$restler->setSupportedFormats('JsonFormat');


$restler->setSupportedFormats('JsonFormat', 'UploadFormat');
$restler->setOverridingFormats('HtmlFormat');
$restler->addAPIClass('action');
$restler->handle();
//header("Content-Type: text/html; charset=utf-8");
