/**
 * Created by khalid alomiri on 21/3/2016.
 */
var lastAddId = ""


function setdatafunction() {
    casetype = arguments[0].TypeProcesses;
    $.ajax({
        url: "../ajax/function.php",
        type: "POST",
        data: arguments[0],
        cache: false,
        dataType: 'html',
        casetype: casetype,
        success: function (html) {
            //  console.clear();
            // console.log(casetype,html);
            // console.log(html);
            switch (casetype) {
                case "login":
                    if (html == 1) {
                        window.location = 'index.php'
                    } else {
                        swal(window.Lang['SignInError'], window.Lang['SignInErrorMsg'], 'error');
                    }
                    break;
                case "creategame":
                    SetStoryData(html)
                    break;
                case "updateGames":
                    saveMessage()
                    break;
                case "RemoveGames":
                    location.reload()
                    break;
                case "split_site":
                    window.location = "story/" + html;
                    removeLoader()
                    break;
                case "getdatagames":
                    //  alert(html.data)
                    //console.log($.parseJSON('[' + html + ']'));
                    data = $.parseJSON('[' + html + ']')



                   if(data[0].data!=null && data[0].data!=''){


                        game = $.parseJSON(data[0].data);

                    }else{

                        dataTypeEditore = (Subtype)
                        game.typeEdit = dataTypeEditore

                        game.objects=[];
                        addTitleQustion()

                        switch (game.typeEdit) {
                            case "matching":
                                initMatching()
                                break;

                            case "TrueAndFalse":
                                appendTrueOrFalseControl()
                                break;
                            case "fillBox":
                                // alert("fillBox")
                                // showFillControle(idObject)
                                // $(".fontDrop").show();
                                // $(".inputType").show();
                                $(".addBackgroundFill").show();
                                $(".leftPanelTools .btn.add-text").show();
                                break;
                            default:
                                console.log("load")

                        }




                    }


                    DrawObjects();

                    changeBackground(config.rootPath + "all/images/bg.png")
                    $(".gameContent").click()
                    if ($(".elementResizable ").length) {
                        $(".elementResizable ")[0].click()
                    }
                    //console.log(data)
                    //   console.log($.parseJSON(data[0].data))


                    //
                    //console.log(html);
                    break;
            }
        }

    });
}

/*setdatafunction(
 {
 TypeProcesses: 'creategame',
 name:'new games1',
 description: 'description',
 thumb: 'images/Thumb.png',
 data:'',
 Category: 0,
 type:1
 });*/



/*
 setdatafunction(
 {TypeProcesses:'RemoveGames',
 gameid:currentGameID

 });
 */


/*
 setdatafunction(
 {TypeProcesses:'updateGames',
 id:30,
 name:'updategames new',
 category:'1',
 description:'description new ',
 thumb:'themb new .jpg',
 type:'2',
 delete:0

 });*/


/*setdatafunction(
 {TypeProcesses:'getdatagames',
 id:1


 });*/
