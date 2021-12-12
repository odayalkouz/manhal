(function(){var Loader=this.SpriteLoader={};Loader.preload=function(images,callback){if(typeof(images)==="string"){images=[images]}
    var i,data={callback:callback,numLoaded:0,numImages:images.length,images:[]};for(i=0;i<images.length;i+=1){Loader.load(images[i],data)}};Loader.load=function(imageSource,data){var image=new Image();data.images.push(image);image.onload=function(){data.numLoaded+=1;if(data.numLoaded===data.numImages){data.callback(data.images)}};image.src=imageSource}}());(function($,window){var Spin=window.SpriteSpin={};var api=Spin.api={};Spin.modules={};Spin.behaviors={};Spin.disableSelection=function(e){e.attr('unselectable','on').css({"-moz-user-select":"none","-khtml-user-select":"none","-webkit-user-select":"none","user-select":'none'}).on('selectstart',!1);return e};Spin.updateInput=function(e,data){if(e.touches===undefined&&e.originalEvent!==undefined){e.touches=e.originalEvent.touches}
    data.oldX=data.currentX;data.oldY=data.currentY;if(e.touches!==undefined&&e.touches.length>0){data.currentX=e.touches[0].clientX;data.currentY=e.touches[0].clientY}else{data.currentX=e.clientX;data.currentY=e.clientY}
    if(data.startX===undefined||data.startY===undefined){data.startX=data.currentX;data.startY=data.currentY;data.clickframe=data.frame}
    if(data.oldX===undefined||data.oldY===undefined){data.oldX=data.currentX;data.oldY=data.currentY}
    data.dX=data.currentX-data.startX;data.dY=data.currentY-data.startY;data.dW=data.dX*data.dragDirX+data.dY*data.dragDirY;data.ddX=data.currentX-data.oldX;data.ddY=data.currentY-data.oldY;data.ddW=data.ddX*data.dragDirX+data.ddY*data.dragDirY;return!1};Spin.resetInput=function(data){data.startX=undefined;data.startY=undefined;data.currentX=undefined;data.currentY=undefined;data.oldX=undefined;data.oldY=undefined;data.dX=0;data.dY=0;data.dW=0;data.ddX=0;data.ddY=0;data.ddW=0;if(typeof(data.module.resetInput)==="function"){data.module.resetInput(data)}};Spin.clamp=function(value,min,max){return(value>max?max:(value<min?min:value))};Spin.wrap=function(value,min,max,size){while(value>max){value-=size}
    while(value<min){value+=size}
    return value};Spin.reload=function(data,andInit){if(andInit&&data.module.initialize){data.module.initialize(data)}
    Spin.prepareBackground(data);Spin.preloadImages(data,function(){Spin.rebindEvents(data);data.module.reload(data);data.target.trigger("onLoad",data)})};Spin.preloadImages=function(data,callback){data.preload.fadeIn(250,function(){SpriteLoader.preload(data.source,function(images){data.preload.fadeOut(250,function(){data.preload.hide()});data.stage.show();if(data.canvas){data.canvas.show()}
    data.images=images;callback.apply(data.target,[data])})})};Spin.prepareBackground=function(data){var w=[data.width,"px"].join("");var h=[data.height,"px"].join("");data.target.css({width:w,height:h,position:"relative"});var css={width:w,height:h,top:"0px",left:"0px",position:"absolute"};$.extend(css,data.preloadCSS||{});data.preload.css(css).html(data.preloadHtml||"").hide();data.stage.css({width:w,height:h,top:"0px",left:"0px",position:"absolute"}).hide();if(data.canvas){data.canvas[0].width=data.width;data.canvas[0].height=data.height;data.canvas.css({width:w,height:h,top:"0px",left:"0px",position:"absolute"}).hide()}};Spin.draw=function(data){data.module.draw(data)};Spin.rebindEvents=function(data){var target=data.target;target.unbind('.spritespin');var beh=data.behavior;if(typeof(data.behavior)==="string"){beh=Spin.behaviors[data.behavior]}
    beh=beh||{};var prevent=function(e){if(e.cancelable){e.preventDefault()}
        return!1};target.bind('mousedown.spritespin',beh.mousedown||$.noop);target.bind('mousemove.spritespin',beh.mousemove||$.noop);target.bind('mouseup.spritespin',beh.mouseup||$.noop);target.bind('mouseenter.spritespin',beh.mouseenter||$.noop);target.bind('mouseover.spritespin',beh.mouseover||$.noop);target.bind('mouseleave.spritespin',beh.mouseleave||$.noop);target.bind('dblclick.spritespin',beh.dblclick||$.noop);target.bind('onFrame.spritespin',beh.onFrame||$.noop);if(data.touchable){target.bind('touchstart.spritespin',beh.mousedown||$.noop);target.bind('touchmove.spritespin',beh.mousemove||$.noop);target.bind('touchend.spritespin',beh.mouseup||$.noop);target.bind('touchcancel.spritespin',beh.mouseleave||$.noop);target.bind('click.spritespin',prevent);target.bind('gesturestart.spritespin',prevent);target.bind('gesturechange.spritespin',prevent);target.bind('gestureend.spritespin',prevent)}
    target.bind("mousedown.spritespin selectstart.spritespin",prevent);target.bind("onFrame.spritespin",function(event,data){Spin.draw(data)});target.bind("onLoad.spritespin",function(event,data){data.target.spritespin("animate",data.animate,data.loop)});if(typeof(data.onFrame)==="function"){target.bind("onFrame.spritespin",data.onFrame)}
    if(typeof(data.onLoad)==="function"){target.bind("onLoad.spritespin",data.onLoad)}};$.fn.spritespin=function(method){if(api[method]){return api[method].apply(this,Array.prototype.slice.call(arguments,1))}
    if(typeof(method)==='object'||!method){return api.init.apply(this,arguments)}
    $.error('Method '+method+' does not exist on jQuery.spritespin')};api.init=function(options){var settings={width:undefined,height:undefined,frames:36,frame:0,module:"360",behavior:"drag",animate:!0,loop:!1,loopFrame:0,frameStep:1,frameTime:36,frameWrap:!0,reverse:!1,sense:1,orientation:"horizontal",source:undefined,preloadHtml:undefined,preloadCSS:undefined,onFrame:undefined,onLoad:undefined,touchable:undefined};options=(options||{});$.extend(settings,options);return this.each(function(){var $this=$(this);var data=$this.data('spritespin');if(!data){var images=$this.find("img");var i=0;if(images.length>0){settings.source=[];for(i=0;i<images.length;i+=1){settings.source.push($(images[i]).attr("src"))}}
    if(typeof(settings.source)==="string"){settings.source=[settings.source]}
    Spin.disableSelection($this).css({overflow:"hidden",position:"relative"});$this.empty();$this.append($("<div class='spritespin-stage'/>"));$this.append($("<div class='spritespin-preload'/>"));$this.addClass("spritespin-instance");if(settings.enableCanvas){var canvas=$("<canvas class='spritespin-canvas'/>")[0];var supported=!!(canvas.getContext&&canvas.getContext('2d'));if(supported){settings.canvas=$(canvas);settings.context=canvas.getContext("2d");$this.append(settings.canvas)}}
    if(typeof(settings.module)==="string"){settings.module=SpriteSpin.modules[settings.module]}
    settings.target=$this;settings.stage=$this.find(".spritespin-stage");settings.preload=$this.find(".spritespin-preload");settings.animation=null;settings.touchable=(settings.touchable||(/iphone|ipod|ipad|android/i).test(window.navigator.userAgent));$this.data('spritespin',settings);SpriteSpin.reload(settings,!0)}else{$.extend(data,options);if(options.source){SpriteSpin.reload(data)}else{$this.spritespin("animate",data.animate,data.loop)}}})};api.destroy=function(){return this.each(function(){var $this=$(this);$this.unbind('.spritespin');$this.removeData('spritespin')})};api.update=function(frame){return this.each(function(){var $this=$(this);var data=$this.data('spritespin');if(frame===undefined){data.frame+=((data.animation&&data.reverse)?-data.frameStep:data.frameStep)}else{data.frame=frame}
    if(data.animation||(!data.animation&&data.frameWrap)){data.frame=Spin.wrap(data.frame,0,data.frames-1,data.frames)}else{data.frame=Spin.clamp(data.frame,0,data.frames-1)}
    if(!data.loop&&data.animation&&(data.frame===data.loopFrame)){api.animate.apply(data.target,[!1])}
    data.target.trigger("onFrame",data)})};api.animate=function(animate,loop){if(animate===undefined){return $(this).data('spritespin').animation!==null}
    return this.each(function(){var $this=$(this);var data=$this.data('spritespin');if(typeof(loop)==="boolean"){data.loop=loop}
        if(animate==="toggle"){data.animate=!data.animate}
        if(typeof(animate)==="boolean"){data.animate=animate}
        if(data.animation){window.clearInterval(data.animation);data.animation=null}
        if(data.animate){data.animation=window.setInterval(function(){try{$this.spritespin("update")}catch(err){}},data.frameTime)}})};api.frame=function(frame){if(frame===undefined){return $(this).data('spritespin').frame}
    return this.each(function(){$(this).spritespin("update",frame)})};api.loop=function(value){if(value===undefined){return $(this).data('spritespin').loop}
    return this.each(function(){var $this=$(this);$this.spritespin("animate",$this.data('spritespin').animate,value)})};api.next=function(){return this.each(function(){var $this=$(this);$this.spritespin("frame",$this.spritespin("frame")+1)})};api.prev=function(){return this.each(function(){var $this=$(this);$this.spritespin("frame",$this.spritespin("frame")-1)})};api.animateTo=function(frame){return this.each(function(){var $this=$(this);$this.spritespin({animate:!0,loop:!1,loopFrame:frame})})};Spin.behaviors.none={name:"none",mousedown:$.noop,mousemove:$.noop,mouseup:$.noop,mouseenter:$.noop,mouseover:$.noop,mouseleave:$.noop,dblclick:$.noop,onFrame:$.noop}}(jQuery,window));(function($,window,Spin){Spin.behaviors.click={name:"click",mouseup:function(e){var $this=$(this),data=$this.data('spritespin');Spin.updateInput(e,data);$this.spritespin("animate",!1);var h,p,o=data.target.offset();if(data.orientation=="horizontal"){h=data.width/2;p=data.currentX-o.left}else{h=data.height/2;p=data.currentY-o.top}
    if(p>h){$this.spritespin("frame",data.frame+1);data.reverse=!1}else{$this.spritespin("frame",data.frame-1);data.reverse=!0}}}}(jQuery,window,window.SpriteSpin));(function($,window,Spin){Spin.behaviors.drag={name:"drag",mousedown:function(e){var $this=$(this),data=$this.data('spritespin');Spin.updateInput(e,data);data.onDrag=!0},mousemove:function(e){var $this=$(this),data=$this.data('spritespin');if(data.onDrag){Spin.updateInput(e,data);var d;if(data.orientation=="horizontal"){d=data.dX/data.width}else{d=data.dY/data.height}
    var dFrame=d*data.frames*data.sense;var frame=Math.round(data.clickframe+dFrame);$this.spritespin("update",frame);$this.spritespin("animate",!1)}},mouseup:function(e){var $this=$(this),data=$this.data('spritespin');Spin.resetInput(data);data.onDrag=!1},mouseleave:function(e){var $this=$(this),data=$this.data('spritespin');Spin.resetInput(data);data.onDrag=!1}}}(jQuery,window,window.SpriteSpin));(function($,window,Spin){Spin.behaviors.hold={name:"hold",mousedown:function(e){var $this=$(this),data=$this.data('spritespin');Spin.updateInput(e,data);data.onDrag=!0;$this.spritespin("animate",!0)},mousemove:function(e){var $this=$(this),data=$this.data('spritespin');if(data.onDrag){Spin.updateInput(e,data);var h,d,o=data.target.offset();if(data.orientation=="horizontal"){h=(data.width/2);d=(data.currentX-o.left-h)/h}else{h=(data.height/2);d=(data.currentY-o.top-h)/h}
    data.reverse=d<0;d=d<0?-d:d;data.frameTime=80*(1-d)+20}},mouseup:function(e){var $this=$(this),data=$this.data('spritespin');Spin.resetInput(data);data.onDrag=!1;$this.spritespin("animate",!1)},mouseleave:function(e){var $this=$(this),data=$this.data('spritespin');Spin.resetInput(data);data.onDrag=!1;$this.spritespin("animate",!1)},onFrame:function(e){var $this=$(this);$this.spritespin("animate",!0)}}}(jQuery,window,window.SpriteSpin));(function($,window,Spin){Spin.behaviors.swipe={name:"swipe",mousedown:function(e){var $this=$(this),data=$this.data('spritespin');Spin.updateInput(e,data);data.onDrag=!0},mousemove:function(e){var $this=$(this),data=$this.data('spritespin');if(data.onDrag){Spin.updateInput(e,data);var frame=data.frame;var snap=data.snap||0.25;var d,s;if(data.orientation=="horizontal"){d=data.dX;s=data.width*snap}else{d=data.dY;s=data.height*snap}
    if(d>s){frame=data.frame-1;data.onDrag=!1}else if(d<-s){frame=data.frame+1;data.onDrag=!1}
    $this.spritespin("update",frame);$this.spritespin("animate",!1)}},mouseup:function(e){var $this=$(this),data=$this.data('spritespin');data.onDrag=!1;Spin.resetInput(data)},mouseleave:function(e){var $this=$(this),data=$this.data('spritespin');data.onDrag=!1;Spin.resetInput(data)}}}(jQuery,window,window.SpriteSpin));(function($,window){var Module=window.SpriteSpin.modules["360"]={};Module.reload=function(data){var images=$(data.images);data.stage.empty()
    data.modopts={is_sprite:(data.images.length==1),resX:(data.resolutionX||data.images[0].width),resY:(data.resolutionY||data.images[0].height),offX:(data.offsetX||0),offY:(data.offsetY||0),stepX:(data.stepX||data.width),stepY:(data.stepY||data.height),numFramesX:(data.framesX||data.frames),oldFrame:data.frame,images:images};if(!data.modopts.is_sprite&&!data.canvas){data.stage.append(images)}
    images.css({width:data.modopts.resX,height:data.modopts.resY});Module.draw(data)};Module.draw=function(data){if(data.modopts.is_sprite){Module.drawSpritesheet(data)}else{Module.drawImages(data)}};Module.drawSpritesheet=function(data){var opts=data.modopts;var image=data.source[0];var frameX=(data.frame%opts.numFramesX);var frameY=(data.frame/opts.numFramesX)|0;var x=opts.offX+frameX*opts.stepX;var y=opts.offY+frameY*opts.stepY;if(data.canvas){data.context.clearRect(0,0,data.width,data.height);data.context.drawImage(data.images[0],x,y,data.width,data.height,0,0,data.width,data.height);return}
    data.stage.css({width:[data.width,"px"].join(""),height:[data.height,"px"].join(""),"background-image":["url('",image,"')"].join(""),"background-repeat":"no-repeat","background-position":[-x,"px ",-y,"px"].join(""),"-webkit-background-size":[opts.resX,"px ",opts.resY,"px"].join("")})};Module.drawImages=function(data){var img=data.images[data.frame];if(data.canvas){data.context.clearRect(0,0,data.width,data.height);data.context.drawImage(img,0,0);return}
    var frame=data.stage.css({width:[data.width,"px"].join(""),height:[data.height,"px"].join("")}).children().hide()[data.frame];SpriteSpin.disableSelection($(frame)).show()}}(window.jQuery,window));(function($,window){var Module=window.SpriteSpin.modules.gallery={};Module.reload=function(data){data.images=[];data.offsets=[];data.stage.empty();data.speed=500;data.opacity=0.25;data.oldFrame=0;var size=0,i=0;for(i=0;i<data.source.length;i+=1){var img=$("<img src='"+data.source[i]+"'/>");data.stage.append(img);data.images.push(img);data.offsets.push(-size+(data.width-img[0].width)/2);size+=img[0].width;img.css({opacity:0.25})}
    data.stage.css({width:size});data.images[data.oldFrame].animate({opacity:1},data.speed)};Module.draw=function(data){if((data.oldFrame!=data.frame)&&data.offsets){data.stage.stop(!0,!1);data.stage.animate({"left":data.offsets[data.frame]},data.speed);data.images[data.oldFrame].animate({opacity:data.opacity},data.speed);data.oldFrame=data.frame;data.images[data.oldFrame].animate({opacity:1},data.speed)}else{data.stage.css({"left":data.offsets[data.frame]+data.dX})}};Module.resetInput=function(data){if(!data.onDrag){data.stage.animate({"left":data.offsets[data.frame]})}}}(jQuery,window));(function($,window){var Module=window.SpriteSpin.modules.panorama={};Module.reload=function(data){data.stage.empty();var opts=data.modopts={};opts.resX=(data.resolutionX||data.images[0].width);opts.resY=(data.resolutionY||data.images[0].height);if(data.orientation=="horizontal"){opts.frames=(data.frames||opts.resX)}else{opts.frames=(data.frames||opts.resY)}
    Module.drawFirst(data)};Module.draw=function(data){var opts=data.modopts;var x,y;if(data.orientation=="horizontal"){x=(data.frame%opts.frames);y=0}else{x=0;y=(data.frame%opts.frames)}
    data.stage.css({"background-position":[-x,"px ",-y,"px"].join("")})};Module.drawFirst=function(data){var opts=data.modopts;var x,y;if(data.orientation=="horizontal"){x=(data.frame%opts.frames);y=0}else{x=0;y=(data.frame%opts.frames)}
    data.stage.css({width:[data.width,"px"].join(""),height:[data.height,"px"].join(""),"background-image":["url('",data.source[0],"')"].join(""),"background-repeat":"repeat-both","background-position":[-x,"px ",-y,"px"].join(""),"-webkit-background-size":[opts.resX,"px ",opts.resY,"px"].join("")})}}(window.jQuery,window))