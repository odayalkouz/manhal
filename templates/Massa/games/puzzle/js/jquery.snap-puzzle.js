/*
	jQuery snapPuzzle v1.0.0
    Copyright (c) 2014 Hans Braxmeier / Simon Steinberger / Pixabay
    GitHub: https://github.com/Pixabay/jQuery-snapPuzzle
	License: http://www.opensource.org/licenses/mit-license.php
*/
var lbl_data1="أحسنت ... ";
var lbl_data2="إلعب مرة أخرى"
var lbl_data3="رتب القصة";


var lbl_data4="بالتسلسل الصحيح";
var lbl_data5="هل تريد";
var lbl_data6="الخروج من اللعبة؟";
var lbl_data7="أعد تركيب الصورة"
var lbl_data8="بالشكل الصحيح"
$(document).ready(function() {
    $.fn.snapPuzzle = function(options){
        var o = $.extend({ pile: '', containment: 'document', rows: 5, columns: 5, onComplete: function(){} }, options);

        // public methods
        if (typeof options == 'string') {
            this.each(function(){
                var that = $(this),
                    o = that.data('options'),
                    pieceWidth = that.width() / o.columns,
                    pieceHeight = that.height() / o.rows,
                    pile = $(o.pile),
                    maxX = pile.width() - pieceWidth,
                    maxY = pile.height() - pieceHeight,
                    puzzle_offset = that.closest('span').offset(),
                    pile_offset = pile.offset();

                if (options == 'destroy') {
                    $('.'+o.puzzle_class).remove();
                    that.unwrap().removeData('options');
                    pile.removeClass('snappuzzle-pile');
                } else if (options == 'refresh') {
                    $('.snappuzzle-slot.'+o.puzzle_class).each(function(){
                        var x_y = $(this).data('pos').split('_'), x = x_y[0], y = x_y[1];
                        $(this).css({
                            width: pieceWidth,
                            height: pieceHeight,
                            left: y*pieceWidth,
                            top: x*pieceHeight
                        });
                    });
                    $('.snappuzzle-piece.'+o.puzzle_class).each(function(){
                        if ($(this).data('slot')) {
                            // placed on slot
                            var x_y = $(this).data('slot').split('_'), slot_x = x_y[0], slot_y = x_y[1],
                                x_y = $(this).data('pos').split('_'), pos_x = x_y[0], pos_y = x_y[1];;
                            $(this).css({
                                width: pieceWidth,
                                height: pieceHeight,
                                left: slot_y*pieceWidth+puzzle_offset.left-pile_offset.left,
                                top: slot_x*pieceHeight+puzzle_offset.top-pile_offset.top,
                                backgroundImage: 'url('+cutpartOFimage((y*pieceWidth),(x*pieceHeight),pieceWidth,pieceHeight,function(o){
                                    //alert((-y*pieceWidth))
                                    $(this).css('backgroundImage',o)
                                })+')',
                            });
                        } else {
                            // placed anywhere else
                            var x_y = $(this).data('pos').split('_'), x = x_y[0], y = x_y[1];
                            $(this).css({
                                width: pieceWidth,
                                height: pieceHeight,
                                left: Math.floor((Math.random()*(maxX+1))),
                                top: Math.floor((Math.random()*(maxY+1))),
                                backgroundImage: 'url('+cutpartOFimage((y*pieceWidth),(x*pieceHeight),pieceWidth,pieceHeight,function(o){
                                    //alert((-y*pieceWidth))
                                    $(this).css('backgroundImage',o)
                                })+')',
                            });
                        }
                    });
                }
            });
            return this;
        }

        function init(that){
            var puzzle_class = 'sp_'+new Date().getTime(),
                puzzle = that.wrap('<span class="snappuzzle-wrap"/>').closest('span'),
                src = that.attr('src'),
                pieceWidth = that.width() / o.columns,
                pieceHeight = that.height() / o.rows,
                pile = $(o.pile).addClass('snappuzzle-pile'),
                maxX = pile.width() - pieceWidth,
                maxY = pile.height() - pieceHeight;

            o.puzzle_class = puzzle_class;
            that.data('options', o);

            for (var x=0; x<o.rows; x++) {

                for (var y=0; y<o.columns; y++) {

                    $('<div class="snappuzzle-piece banners HardwareAccelerated '+puzzle_class+'"/>').data('pos', x+'_'+y).css({
                        width: pieceWidth,
                        height: pieceHeight,
                        position: 'absolute',
                        //border:'1px solid red',
                        left: Math.floor((Math.random()*(maxX+1))),
                        top: Math.floor((Math.random()*(maxY+1))),
                        zIndex: Math.floor(Math.random() * (1000 - 200 + 1)) + 200,
                        backgroundImage: 'url('+cutpartOFimage((y*pieceWidth),(x*pieceHeight),pieceWidth,pieceHeight,function(o){
                            //alert((-y*pieceWidth))
                            $(this).css('backgroundImage',o)
                        })+')',
                        //backgroundPosition: (-y*pieceWidth)+'px '+(-x*pieceHeight)+'px',
                        //backgroundSize: that.width()
                    }).draggable({

                        revert: function() {
                            if ($(this).hasClass('drag-revert')) {
                                $(this).removeClass('drag-revert');
                                return true;
                            }
                        },
                        start: function(e, ui){
                            soundEffect("sound/move.mp3")
                            $('.snappuzzle-piece').hide();
                            $(this).show()
                            ; $(this).removeData('slot'); },
                        stop:function(e,ui){

                            setTimeout(function(){


                                $('.snappuzzle-piece').show();
                            },0000)

                            if(!$('.snappuzzle-piece').hasClass('correct')){

                            $('.snappuzzle-piece').draggable('enable')
                        }},

                        stack: '.snappuzzle-piece',
                        containment: o.containment
                    }).appendTo(pile).data('lastSlot', pile);

                    $('<div class="snappuzzle-slot '+puzzle_class+'"/>').data('pos', x+'_'+y).css({
                        width: pieceWidth,
                        height: pieceHeight,
                        left: y*pieceWidth,
                        top: x*pieceHeight
                    }).appendTo(puzzle).droppable({
                        //accept: '.'+puzzle_class,
                        hoverClass: 'snappuzzle-slot-hover',
                        drop: function(e, ui){
                           setTimeout(function(){
                               if(!$('.snappuzzle-piece').hasClass('correct')){
                                   $('.snappuzzle-piece').draggable('enable')
                               }

                           },0)
                            var slot_pos = $(this).data('pos');

                            // prevent dropping multiple pieces on one slot
                            $('.snappuzzle-piece.'+puzzle_class).each(function(){
                                if ($(this).data('slot') == slot_pos){

                                    slot_pos = false;
                                }

                            });
                            if (!slot_pos) return false;

                           // ui.draggable.data('lastSlot', $(this)).data('slot', slot_pos);
                           // ui.draggable.position({ of: $(this), my: 'left top', at: 'left top' });



                            if (ui.draggable.data('pos')==slot_pos) {

                                ui.draggable.addClass('correct');
                                //playSound('../sound/magicwand.mp3',false,false);
                               soundEffect("sound/correctA.mp3")
                                // fix piece
                                // $(this).droppable('disable').fadeIn().fadeOut();
                                $(this).droppable('disable').css('opacity', 1).fadeOut(1000);
                                ui.draggable.css({opacity: 0, cursor: 'default'}).draggable('disable');
                                if ($('.snappuzzle-piece.correct.'+puzzle_class).length == o.rows*o.columns) o.onComplete(that);
                                return
                            }
                           soundEffect("sound/wrongA.mp3")
                        }
                    });
                }
            }

        }

        setTimeout(function(){$('.snappuzzle-piece').addClass('animated zoomIn');},0)

        setTimeout(function(){$('.snappuzzle-piece').removeClass('animated zoomIn')},4000)
        return this.each(function(){
            if (this.complete) init($(this));
            else $(this).load(function(){ init($(this)); });
        });
    };
})


function cutpartOFimage(x,y,width,height,callback){
    var tempCanvas = document.createElement("canvas"),
        tCtx = tempCanvas.getContext("2d");

    tempCanvas.width = width;
    tempCanvas.height = height;

    tCtx.drawImage(canvas,x,y,width,height,0,0,width,height);

    callback(tempCanvas.toDataURL());
  return tempCanvas.toDataURL();
}


function playSound(src,next,loop){
    // stopAll()

    $("<audio class='media'></audio>").attr({
        'src':src,
        'volume':0.8,
        'id':"soundplug",
        'autoplay':'autoplay',
        loop:loop,
    }).appendTo("body");




    $('.media').on('ended', function() {
        if(!next)return
        $(".swiper-button-next").addClass('animated shake');
        nextPage()
    });


    $('.media').bind('pause', function () { //should trigger once on every pause event

    });

}



