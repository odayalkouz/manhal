<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 09/04/2017
 * Time: 10:54 ص
 */
?>
<link rel="stylesheet" type="text/css" href="themes/Light-green-En/css/style.css">
<script type="text/javascript" src="https://www.manhal.com/js/jquery.js"></script>
<script type="text/javascript">
   // window.SITE_URL = "http://localhost/Manhal/";
      window.SITE_URL = "https://www.manhal.com/";
    function check() {
        value = {TypeProcesses: 'checkshowroomrating', email: "khalid@manhal.com", showroom: 0};
        $.ajax({
            url: window.SITE_URL + "platform/ajax/process.php",
            type: "POST",
            data: value,
            success: function (data) {
                console.log("check=", data);
            }
        });
    }
    function setdata() {

        value = {
            TypeProcesses: 'showroomrating',
            name: 'khakid',
            email: "khalidalomire@gmail.com",
            age: 20,
            sex: 0,
            telephone: "+0962799854522",
            rating: 5,
            type: 'mp3',
            showroom: 0,
            msg: "msg to khalid alomiri",
            datafile: ''
        };
        $.ajax({
            url: window.SITE_URL + "platform/ajax/showroomprocess.php",
            type: "POST",
            data: value,
            success: function (data) {
                console.log("setdata=", data);
            }
        });
    }
    currentpage =1;
    PerPage = 2;
    $(document).ready(function () {

        admin();
        $("#showroom").change(function () {
            admin()
        });
        $("#Rating").change(function () {
            admin()
        });
        $("#typemsg").change(function () {
            admin()
        });
        $("#gender").change(function () {
            admin()
        });
        $("#clicksearch").click(function () {
            admin()
        });
    });

    function admin() {

        if (isNaN($("#fromage").val())) {
            $("#fromage").val('');
        }
        if (isNaN($("#toage").val())) {
            $("#toage").val('');
        }

        if ($("#fromage").val() != '' && $("#toage").val() == '') {
            $("#toage").val($("#fromage").val());
        } else if ($("#fromage").val() == '' && $("#toage").val() != '') {
            $("#fromage").val($("#toage").val())
        }


        value = {
            TypeProcesses: 'filter',
            keywords: $("#_search").val(),
            showroom: $("#showroom").val(),
            rate: $("#Rating").val(),
            type: $("#typemsg").val(),
            gender: $("#gender").val(),
            fromage: $("#fromage").val(),
            toage: $("#toage").val(),
            fromdate: $("#fromdate").val(),
            todate: $("#todate").val(),
            itemperpage: PerPage,
            page: currentpage

        };
        $.ajax({
            url: window.SITE_URL + "platform/ajax/showroomprocess.php",
            type: "POST",
            data: value,
            success: function (data) {
                data = JSON.parse(data);
                loopdata = data[1];
                var Alldata = '';
                for (var i = 0; i < loopdata.length; i++) {
                    console.log(loopdata[i]);
                    var getdata = '<div id="" class="display-table-row bg-row-green">';
                    getdata += '<div class="display-table-cell number">' + i + '</div>';
                    getdata += '<div class="display-table-cell name">' + loopdata[i].name + '</div>';
                    getdata += '<div class="display-table-cell name">' + loopdata[i].telephone + '</div>';
                    getdata += '<div class="display-table-cell name">' + loopdata[i].email + '</div>';
                    getdata += '<div class="display-table-cell number">' + loopdata[i].rate + '</div>';
                    var gender = 'Male';
                    if (loopdata[i].sex != 0) {
                        gender = 'Female';
                    }
                    getdata += '<div class="display-table-cell number">' + gender + '</div>';
                    getdata += '<div class="display-table-cell number">' + loopdata[i].age + '</div>';
                    if (loopdata[i].type == 'msg') {
                        getdata += '<div class="display-table-cell name">' + loopdata[i].msg + '</div>';
                    } else if (loopdata[i].type == 'png') {
                        getdata += '<img width="50px" height="50px" src="ratingmediashowroom/' + loopdata[i].showroom + '/' + loopdata[i].id + '.png">';
                    } else if (loopdata[i].type == 'mp3') {
                        getdata += '<audio controls=""><source src="ratingmediashowroom/' + loopdata[i].showroom + '/' + loopdata[i].id + '.mp3" type="audio/mp3"> </audio>';
                    } else if (loopdata[i].type == 'mp4') {
                        getdata += '<video  controls=""><source src="ratingmediashowroom/' + loopdata[i].showroom + '/' + loopdata[i].id + '.mp4" type="video/mp4"></video>';
                    }
                    getdata += '</div>';
                    Alldata += getdata;
                }

                $("#containerdata").html(Alldata);
                $("#pagination").html(getPagination(data[2], PerPage));


            }
        });
    }

    PagesOfPagination=9;
    function getPagination(num_rows, PerPage) {
        current = currentpage;
        result1 = '';
        prev = current - 1;
        next = current + 1;
        Pages_number = Math.ceil(num_rows / PerPage);
        if (Pages_number > 1) {
            if (current > PagesOfPagination / 2) {
                pageBegin = (current - Math.ceil(PagesOfPagination / 2)) + 1;
                if (Pages_number > PagesOfPagination) {
                    pageEnd = (current + Math.ceil(PagesOfPagination / 2)) - 1;
                } else {
                    pageEnd = $Pages_number;
                }
            } else {
                pageBegin = 1;
                if (Pages_number > PagesOfPagination) {
                    pageEnd = PagesOfPagination;
                } else {
                    pageEnd = Pages_number;
                }
            }
            if (pageEnd > Pages_number) {
                pageEnd = Pages_number;
                if (Pages_number - PagesOfPagination + 1 > 0) {
                    pageBegin = Pages_number - PagesOfPagination + 1;
                } else {
                    pageBegin = 1;
                }
            }
            if (pageBegin > 1 && Pages_number - pageBegin < PagesOfPagination - 1) {
                pageBegin = 1;
            }
            result = "";
            for (i = pageBegin; i <= pageEnd; i++) {
                if (current == i) {
                    result += "<a onclick='gotopage("+i+")' class='selected page floating-left'  >i</a>";
                } else {
                    result += "<a onclick='gotopage("+i+")' class='page floating-left'>i</a>";
                }
            }
            if (current != 1) {
                first = "<a onclick='gotopage(1)' ><i class='flaticon-arrowheads3'></i></a>";
            } else {
                first = "";
            }
            if (prev > 0) {
                previus = "<a onclick='gotopage("+prev+")' ><i class='flaticon-last-track '></i></a>";
            } else {
                previus = "";
            }

            if (Pages_number != current) {
                last = "<a onclick='gotopage("+Pages_number+")'><i class='flaticon-right39'></i></a>";
            } else {
                last = "";
            }
            if (next <= Pages_number) {
                next_link = " <a onclick='gotopage("+next+")' ><i class='flaticon-right-arrow26'></i></a>";
            } else {
                next_link = "";
            }
            begin = current * PerPage - (PerPage);

            result1 = first + previus + result + next_link + last;
        }
        console.log("kkk=",result1)
        return result1;
    }
function gotopage(value){
    currentpage=value;
    admin()
}


</script>

<html>
<head>

    <style>
        .txt-a {
            display: block;
            overflow: hidden;
            width: 150px;
            font-size: 13px;
            font-weight: 400;
            color: #464646;
            height: 30px;
            line-height: 30px;
            margin: 0;
            border: 1px solid #c2c2c2;
            padding: 0 5px;
            border-radius: 5px;
        }

        .books-container .name {
            display: inline-block;
            overflow: hidden;
            width: 10%;
        }
    </style>
</head>
<body>
<div class="books-container">


    <label class="lbl-data-a floating-left">showroom</label>
    <select class="txt-a floating-left" id="showroom" name="showroom">
        <option value='0'>الإدارة الرئيسي</option>
        <option value='1'>معرض العبدلي</option>
        <option value='2'>معرض خلدا</option>
    </select>

    <label class="lbl-data-a floating-left">التقييم</label>
    <select class="txt-a floating-left" id="Rating" name="Rating">
        <option value=''>All</option>
        <option value='0'>0</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
    </select>

    <label class="lbl-data-a floating-left">Type</label>
    <select class="txt-a floating-left" id="typemsg" name="typemsg">
        <option value=''>All</option>
        <option value='msg'>text</option>
        <option value='png'>image</option>
        <option value='mp3'>sound</option>
        <option value='mp4'> video</option>
    </select>

    <label class="lbl-data-a floating-left">Gender</label>
    <select class="txt-a floating-left" id="gender" name="gender">
        <option value=''>All</option>
        <option value='0'>Male</option>
        <option value='1'>Female</option>
    </select>
    <label class="lbl-data-a floating-left">From Age</label>
    <input type="text" class="txt-a floating-left" id="fromage" name="fromage" placeholder="fromage" value="">
    <label class="lbl-data-a floating-left">To Age</label>
    <input type="text" class="txt-a floating-left" id="toage" name="toage" placeholder="toage" value="">

    <label class="lbl-data-a floating-left">fromdate</label>
    <input name="fromdate" value="" id="fromdate" type="text" class="txt-a floating-left" placeholder="">

    <label class="lbl-data-a floating-left">todate</label>
    <input name="todate" value="" id="todate" type="text" class="txt-a floating-left" placeholder="">

    <input type="text" class="txt-a floating-left book-serach" id="_search" name="_search"
           placeholder="search" value="">
    <input type="button" class="btn-default-b floating-left" value="search" id="clicksearch">


    <div class="display-table">
        <!--start table caption-->
        <div class="disply-table-caption table-title">
            <div class="display-table-cell number">No</div>
            <div class="display-table-cell name">Name</div>
            <div class="display-table-cell name">telephone</div>
            <div class="display-table-cell name">E-mail</div>
            <div class="display-table-cell number">rate</div>
            <div class="display-table-cell number">Gender</div>
            <div class="display-table-cell number">Age</div>
            <div class="display-table-cell name">MSG</div>


        </div>
    </div>
    <div id="containerdata">


    </div>


</div>
<section class="paging">
    <div id="pagination" class="content">

    </div>
</section>

</body>
</html>


