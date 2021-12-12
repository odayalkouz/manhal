<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage = "infopayment.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}
include_once('config.php');
include_once('includes/language.php');
?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');
$bredcrumb = '<li class="floating-left"><a href="warehouse.php" class="floating-left">'.$Lang->Warehouse.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="warehouse.php" class="floating-left">'.$Lang->paymentinformation.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="pkt.php" class="floating-left active">'.$Lang->PKT.'</a></li>';

include "includes/header.php";
?>
<?php
$sql = "SELECT * FROM `payments` WHERE `paymentid`=" . $_GET['id'];
$result = $con->query($sql);
$payments_row = mysqli_fetch_assoc($result)


?>

<script>
    // orgainal_Array=[];
    $(document).ready(function () {
        $("#addprodectbtn").click(function () {
            $("#popup_action").fadeIn();
            $("#carton").fadeOut();
            $("#report").fadeOut();
            $("#addproduct").fadeIn();
            $("#textISBN").focus();
        });
        $("#cartonbtn").click(function () {
            $("#viewCartons").html('');
            $("#popup_action").fadeIn();
            $("#addproduct").fadeOut();
            $("#report").fadeOut();
            $("#carton").fadeIn();
            Carton();
        });

        $("#reportbtn").click(function () {
            $('#viewReport').html('');

            $("#addproduct").fadeOut();
            $("#carton").fadeOut();
            $("#report").fadeIn();
            Report();
        });
        $(".admin-login .popup-container .close-container i").click(function () {
            $("#popup_action").fadeOut();
        });
    })
</script>
<?php

$sql = "Select payments_books.*, books.*,story.storyid,(story.isbn)as story_isbn,(story.weight)as story_weight,(story.awidth)as story_awidth,(story.aheight)as story_aheight From payments_books Left Join books On payments_books.bookid = books.bookid Left Join
  story On payments_books.bookid = story.storyid  where payments_books.paymentid=" . $_GET['id'] . " and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )";


$result = $con->query($sql);
$data = 'original_Array=[];';
$reset_counter = 0;
$i = 0;
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $quantity = $row['quantity'];
        $isbn = $row['isbn'];
        $id = $row['bookid'];
        if ($row['itemtype'] == 'story') {
            $isbn = $row['story_isbn'];
            $id = $row['storyid'];
        }

        $data .= 'original_Array[' . $i . ']={"ISBN":"' . $isbn . '","Quantity":' . $quantity . ',"type":"' . $row['itemtype'] . '","id":"' . $id . '"};';
        $i++;
    }
}


?>
<div class="admin-login" id="popup_action" style="display: none">
    <div class="popup-main-container">
        <div class="popup-tabel">
            <div class="popup-row">
                <div class="popup-cell">
                    <div class="popup-container" style="width: 400px; height: 300px;">
                        <label class="close-container">
                            <i class="flaticon-x floating-right close"></i>
                        </label>
                        <div class="popup-content" style="background: #fff;width: 400px; height: 300px;">
                            <div class="containers" id="addproduct">
                                <input id="textISBN" type="text" value="">
                                <div class="button-container">
                                    <a onclick="AddCartons_fun();" class="btn-default floating-left ">Add Carton</a>
                                </div>
                            </div>
                            <div class="containers" id="carton">
                                <div class="display-table">
                                    <!--start table caption-->
                                    <div class="disply-table-caption table-title" style="background:#fff;color:#00AB67">
                                        <div class="display-table-cell carton-name">Carton</div>
                                        <div class="display-table-cell cartonweight">Carton Weight</div>
                                    </div>
                                    <!--end table caption-->
                                    <!--start table rows-->
                                    <div id="viewCartons">

                                    </div>

                                    <!--end table rows-->
                                </div>
                                <div class="button-container">
                                    <a onclick="SaveCartons()" class="btn-default floating-left ">save</a>
                                </div>
                            </div>
                            <div class="containers" id="report">
                                <div class="display-table">
                                    <!--start table caption-->
                                    <div class="disply-table-caption table-title" style="background:#fff;color:#00AB67">
                                        <div class="display-table-cell carton-quantity">Quantity</div>
                                        <div class="display-table-cell cartonisbn">ISBN</div>
                                    </div>
                                    <!--end table caption-->
                                    <!--start table rows-->
                                    <div id="viewReport"></div>
                                    <!--end table rows-->
                                </div>
                                <div class="button-container">
                                    <a onclick="printReport();" class="btn-default floating-left ">Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="invoice-container">
    <div class="books-container">
        <div class="invoice-bottom" style="margin: 0px 0px 20px 0px">
            <div class="receiver-container">
                <div class="line-row-bill floating-left">
                    <label class="floating-left"><?= $Lang->INVNumber ?></label>
                    <div class="floating-left"><?= $_GET['id'] ?></div>
                </div>
                <div class="line-row-bill floating-left">
                    <label class="floating-left"><?= $Lang->Name ?></label>
                    <div
                        class="floating-left"><?= $payments_row['billing_fullname']  ?></div>
                </div>
                <div class="line-row-bill floating-left">
                    <label class="floating-left"><?= $Lang->Shippingmethod ?></label>
                    <div class="floating-left"><?= $payments_row['shipping'] ?></div>
                </div>
            </div>
        </div>
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell carton-20"><?= $Lang->Quantity ?></div>
                <div class="display-table-cell carton-20"><?= $Lang->Countcartons ?></div>

                <div class="display-table-cell carton-20"><?= $Lang->ISBN ?></div>
                <div class="display-table-cell carton-20"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <div id="prodects">


                <?php
                $edit = true;
                $getsql = "SELECT * FROM `cartoons`  WHERE `idpayments`=" . $_GET['id'] . " ORDER BY `cartoons`.`carton` ASC";
                $getsql = "Select cartoons.*, books.isbn, story.isbn As storyisbn From cartoons Left Outer Join books On cartoons.idprodect = books.bookid And cartoons.prodecttype = 'book' Left Outer Join story On cartoons.idprodect = story.storyid And cartoons.prodecttype = 'story' Where cartoons.idpayments = " . $_GET['id'] . " ORDER BY `cartoons`.`carton` ASC";
                $getresult = $con->query($getsql);
                if (mysqli_num_rows($getresult) > 0) {
                    $edit = false;
                    while ($getrow = mysqli_fetch_assoc($getresult)) {
                        $ISBN = $getrow['isbn'];
                        if ($getrow['prodecttype'] == 'story') {
                            $ISBN = $getrow['storyisbn'];
                        }
                        echo '<div  class="display-table-row ">
                            <div  class="display-table-cell carton-20">' . $getrow['quantity'] . '</div>
                            <div  class="display-table-cell carton-20">' . $getrow['carton'] . '</div>
                            <div class="display-table-cell carton-20">
                            <input disabled="disabled" type="text"  style="width: 150px" class="book_qty" value="' . $ISBN . '">  </div>
                            <div class="display-table-cell carton-20">
                            <div class="butons-container"></div></div></div>';
                    }
                }


                ?>


            </div>
            <!--end table rows-->
        </div>
        <?php if ($payments_row['store_close_user']==-1) { ?>
            <a id="addprodectbtn" class="btn-default floating-right"><?= $Lang->Addproduct ?></a>
            <a id="cartonbtn" class="btn-default floating-right"><?= $Lang->Cartons ?></a>
            <a onclick="ClosesPKT()" class="btn-default floating-right"><?= $Lang->Closes ?></a>
            <a id="reportbtn" onclick="CheckQuantity();" class="btn-default floating-right"><?= $Lang->Report ?></a>
        <?php } ?>
    </div>


</section>
<script language="JavaScript" type="text/javascript">
    <?php echo $data;?>
    Countcartons = 1;
    cartons_arrray = new Array(Countcartons - 1);
    _pkt_array = new Array(original_Array.length);
    function CheckISBNFun(ISBN) {

        if (original_Array.length < 1) {
            return -1;
        }
        for (var i in original_Array) {
            if (original_Array[i].ISBN == ISBN) {
                return i;
            }
        }

        if(ISBN.length<13){
            ISBN="978"+ISBN;
        }else{
            ISBN=ISBN.substring(3,ISBN.length)
        }

        for (var i in original_Array) {
            if (original_Array[i].ISBN == ISBN) {
                return i;
            }
        }

        return -1;
    }
    function Report() {
        var data = CheckQuantity('R');
        if (data.length > 0) {
            var reportdata = '';
            for (var i in data) {
                reportdata += '<div class="display-table-row"> <div class="display-table-cell carton-quantity">' + data[i].Quantity + '</div> <div class="display-table-cell cartonisbn">' + data[i].ISBN + '</div> </div>';
            }
            $('#viewReport').html(reportdata);
            $("#popup_action").fadeIn();
        } else {
            if (CheckCartons() == false) {
                swal({title: "Enter  weights the cartoons"});
                return;
            }
            swal({title: "There is no errors"});

        }

    }
    function printReport() {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Packet No</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write('<style>.display-table { display: table; overflow: hidden; width: 100%; } .disply-table-caption { display: table-caption; overflow: hidden; background-color: #00AB67!important; color: #fff!important; font-size: 15px; font-weight: bold; height: 30px; line-height: 30px; -webkit-print-color-adjust: exact; } .display-table-row { display: block; overflow: hidden; height: 40px; line-height: 40px; font-size: 14px; }.carton-quantity { display: inline-block; overflow: hidden; width: 50%; float: left; } .cartonisbn { display: inline-block; overflow: hidden; width: 50%; float: left; }.display-table-cell { display: block; overflow: hidden; vertical-align: middle; text-align: center; float: left; }.button-container{display: none} </style>');
        mywindow.document.write('<h3>Report Packet No (  <?=$_GET['id']?>  ) </h3>');
        mywindow.document.write(document.getElementById('report').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/
        mywindow.print();
        mywindow.close();
        return true;
    }
    function CheckQuantity(v) {
        var flag = true;
        var data = [];
        for (var i in original_Array) {
            if (_pkt_array[i] == undefined) {
                console.log(original_Array[i].ISBN, original_Array[i].Quantity);
                data.push({"ISBN": original_Array[i].ISBN, "Quantity": original_Array[i].Quantity});
                flag = false;
            } else if (parseInt(_pkt_array[i].Quantity) < parseInt(original_Array[i].Quantity)) {
                console.log(original_Array[i].ISBN, parseInt(original_Array[i].Quantity) - parseInt(_pkt_array[i].Quantity));
                data.push({
                    "ISBN": original_Array[i].ISBN,
                    "Quantity": parseInt(original_Array[i].Quantity) - parseInt(_pkt_array[i].Quantity)
                })
                flag = false;
            }
        }
        if (v == 'Check') {
            return flag;
        } else if (v == 'R') {
            return data;
        }

    }

    function addprodect(isbn) {
        $("#textISBN").val("");
        var ISBN_FUN = parseInt(CheckISBNFun(isbn));
        if (ISBN_FUN == -1) {
            swal({title: "The value is not valid ISBN"});
            return false;
        }
        if (_pkt_array[ISBN_FUN] != undefined) {
            if (_pkt_array[ISBN_FUN].Quantity == original_Array[ISBN_FUN].Quantity) {
                swal({title: "I have reached the required quantity"});
                return false;
            }

        } else {
            _pkt_array[ISBN_FUN] = {"ISBN": isbn, "Carton": Countcartons, "Quantity": 0}
        }
        var id = "qu_" + isbn + "_" + Countcartons;
        if ($("#" + id).html() == undefined) {
            var random = String(new Date().getDay() + new Date().getTime()).split(".").join("")
            var data = "<div attindex='" + ISBN_FUN + "' id='" + random + "'  class='display-table-row '>";
            data += "<div id='" + id + "' class='display-table-cell carton-20'>1</div>";
            data += "<div id='numcarton" + random + "' class='display-table-cell carton-20'>" + Countcartons + "</div>";
            data += "<div class='display-table-cell carton-20'>";
            data += "<input disabled='disabled' type='text' id='numisbn" + random + "'  style='width: 150px'  class='book_qty' value='" + isbn + "'>  </div>";
            data += "<div class='display-table-cell carton-20'>";
            data += "<div class='butons-container'>";
            data += "<a title='Delete' class='deletegame' onclick='deleteprodect(" + String.fromCharCode(34) + random + String.fromCharCode(34) + ")'><i class='flaticon-delete96'></i></a>";
            data += "</div></div></div>";
            $("#prodects").append(data);
        } else {
            $("#" + id).html(parseInt($("#" + id).html()) + 1);
        }
        if (ISBN_FUN > -1) {
            var Q = _pkt_array[ISBN_FUN].Quantity += 1
            _pkt_array[ISBN_FUN] = {"ISBN": isbn, "Quantity": Q}
        }
    }
    function deleteprodect(v) {
        swal({
            title: window.Lang['Deleted'],
            text: window.Lang['AreyousureDeleteprodect'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                _pkt_array[$("#" + v).attr('attindex')].Quantity = parseInt(_pkt_array[$("#" + v).attr('attindex')].Quantity) - parseInt($("#" + v + " .carton-20").html());
                $("#" + v).remove();
            } else {

            }
        });
    }

    function ClosesPKT() {
        _array = [];

        if (CheckQuantity('Check') == false) {
            swal({title: "Quantity is incorrect"});
            return;
        }
        if (CheckCartons() == false) {
            swal({title: "Enter  weights the cartoons"});
            return;
        }
        $("#prodects .display-table-row").each(function (index) {
            var id = $(this).attr("id");
            var ISBN = $("#numisbn" + id).val();
            var Carton = $("#numcarton" + id).html();
            var Quantity = $("#" + id + " .carton-20").html();
            var index = $("#" + id).attr("attindex");
            _array.push({
                "ISBN": ISBN,
                "Carton": Carton,
                "Quantity": Quantity,
                "id": original_Array[index].id,
                "type": original_Array[index].type
            });
        });

        $.ajax({
            url: "ajax/process.php",
            type: "POST",
            cache: false,
            dataType: 'html',
            data: {
                TypeProcesses: "CloseStock",
                id:<?=$_GET['id']?>,
                prodects: _array,
                cartons: cartons_arrray
            },
            success: function (html) {
                swal({title: "Close Stock"});
                window.location=window.location
            }
        });

        console.log('close PKT');

    }
    $("#textISBN").bind('paste', function (e) {
        $(e.target).keyup(getInput);
    });
    function getInput(e) {
        var inputText = $(e.target).val();
        addprodect(inputText);
        $(e.target).unbind('keyup');
    }

    $("#textISBN").on("keypress ", function (event) {
        if (event.which == 13 && !event.shiftKey) {
            event.preventDefault();
            addprodect($(event.target).val());
        }
    });
    function AddCartons_fun() {

        swal({
            title: window.Lang['Addcartons'],
            text: window.Lang['Areyousureyouwantaddcarton'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                Countcartons++;
                $("#textISBN").focus();
            } else {
                $("#textISBN").focus();
            }
        });
    }
    function Carton() {

        var data = '';
        for (var i = 0; i < Countcartons; i++) {
            var cartoonval = 0;
            if (cartons_arrray[i] != undefined) {
                cartoonval = cartons_arrray[i];
            }
            data += '<div class="display-table-row"><div class="display-table-cell carton-name">' + (i + 1) + '</div><div class="display-table-cell cartonweight"><input id="Cartoon_no' + i + '" type="number" value="' + cartoonval + '"></div></div>';

        }
        $("#viewCartons").html(data);
    }
    function SaveCartons() {
        cartons_arrray = new Array(Countcartons);
        for (var i = 0; i < Countcartons; i++) {
            cartons_arrray[i] = $("#Cartoon_no" + i).val();
        }
    }
    function CheckCartons() {
        for (var i = 0; i < Countcartons; i++) {
            if (cartons_arrray[i] == undefined) {
                return false;
            }
        }
        return true;
    }
</script>
<?php
include "includes/footer.php";
?>
<div class="container" id="viewinfo_container"
     style="display: none;overflow: auto;;min-height:300px;border: 1px solid #00AB67;padding: 20px;background: #fff">
</div>