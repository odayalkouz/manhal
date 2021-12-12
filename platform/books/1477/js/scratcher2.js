Scratcher=(function(){function getEventCoords(ev){var first,coords={};var origEv=ev.originalEvent;if(origEv.changedTouches!=undefined){first=origEv.changedTouches[0];coords.pageX=first.pageX;coords.pageY=first.pageY}else{coords.pageX=ev.pageX;coords.pageY=ev.pageY}
    return coords};function getLocalCoords(elem,coords){var offset=$(elem).offset();return{'x':coords.pageX-offset.left,'y':coords.pageY-offset.top}};function Scratcher(canvasId,backImage,frontImage){this.canvas={'main':$('#'+canvasId).get(0),'temp':null,'draw':null};this.mouseDown=!1;this.canvasId=canvasId;this._setupCanvases();this.setImages(backImage,frontImage);this._eventListeners={}};Scratcher.prototype.setImages=function(backImage,frontImage){this.image={'back':{'url':backImage,'img':null},'front':{'url':frontImage,'img':null}};if(backImage&&frontImage){this._loadImages()}};Scratcher.prototype.fullAmount=function(stride){var i,l;var can=this.canvas.draw;var ctx=can.getContext('2d');var count,total;var pixels,pdata;if(!stride||stride<1){stride=1}
    stride*=4;pixels=ctx.getImageData(0,0,can.width,can.height);pdata=pixels.data;l=pdata.length;total=(l/stride)|0;for(i=count=0;i<l;i+=stride){if(pdata[i]!=0){count++}}
    return count/total};Scratcher.prototype.recompositeCanvases=function(){var tempctx=this.canvas.temp.getContext('2d');var mainctx=this.canvas.main.getContext('2d');this.canvas.temp.width=this.canvas.temp.width;tempctx.drawImage(this.canvas.draw,0,0);tempctx.globalCompositeOperation='source-atop';tempctx.drawImage(this.image.back.img,0,0);mainctx.drawImage(this.image.front.img,0,0);mainctx.drawImage(this.canvas.temp,0,0)};Scratcher.prototype.scratchLine=function(x,y,fresh){var can=this.canvas.draw;var ctx=can.getContext('2d');ctx.lineWidth=30;ctx.lineCap=ctx.lineJoin='round';ctx.strokeStyle='#f00';if(fresh){ctx.beginPath();ctx.moveTo(x+0.01,y)}
    ctx.lineTo(x,y);ctx.stroke();this.dispatchEvent(this.createEvent('scratch'))};Scratcher.prototype._setupCanvases=function(){var c=this.canvas.main;this.canvas.temp=document.createElement('canvas');this.canvas.draw=document.createElement('canvas');this.canvas.temp.width=this.canvas.draw.width=c.width;this.canvas.temp.height=this.canvas.draw.height=c.height;function mousedown_handler(e){var local=getLocalCoords(c,getEventCoords(e));this.mouseDown=!0;this.scratchLine(local.x,local.y,!0);this.recompositeCanvases();this.dispatchEvent(this.createEvent('scratchesbegan'));return!1};function mousemove_handler(e){if(!this.mouseDown){return!0}
    var local=getLocalCoords(c,getEventCoords(e));this.scratchLine(local.x,local.y,!1);this.recompositeCanvases();return!1};function mouseup_handler(e){if(this.mouseDown){this.mouseDown=!1;this.dispatchEvent(this.createEvent('scratchesended'));return!1}
    return!0};$(c).on('mousedown',mousedown_handler.bind(this)).on('touchstart',mousedown_handler.bind(this));$(document).on('mousemove',mousemove_handler.bind(this));$(document).on('touchmove',mousemove_handler.bind(this));$(document).on('mouseup',mouseup_handler.bind(this));$(document).on('touchend',mouseup_handler.bind(this))};Scratcher.prototype.reset=function(){this.canvas.draw.width=this.canvas.draw.width;this.recompositeCanvases();this.dispatchEvent(this.createEvent('reset'))};Scratcher.prototype.mainCanvas=function(){return this.canvas.main};Scratcher.prototype._loadImages=function(){var loadCount=0;function imageLoaded(e){loadCount++;if(loadCount>=2){this.dispatchEvent(this.createEvent('imagesloaded'));this.reset()}}
    for(k in this.image)if(this.image.hasOwnProperty(k)){this.image[k].img=document.createElement('img');$(this.image[k].img).on('load',imageLoaded.bind(this));this.image[k].img.src=this.image[k].url}};Scratcher.prototype.createEvent=function(type){var ev={'type':type,'target':this,'currentTarget':this};return ev};Scratcher.prototype.addEventListener=function(type,handler){var el=this._eventListeners;type=type.toLowerCase();if(!el.hasOwnProperty(type)){el[type]=[]}
    if(el[type].indexOf(handler)==-1){el[type].push(handler)}};Scratcher.prototype.removeEventListener=function(type,handler){var el=this._eventListeners;var i;type=type.toLowerCase();if(!el.hasOwnProperty(type)){return}
    if(handler){if((i=el[type].indexOf(handler))!=-1){el[type].splice(i,1)}}else{el[type]=[]}};Scratcher.prototype.dispatchEvent=function(ev){var el=this._eventListeners;var i,len;var type=ev.type.toLowerCase();if(!el.hasOwnProperty(type)){return}
    len=el[type].length;for(i=0;i<len;i++){el[type][i].call(this,ev)}};if(!Function.prototype.bind){Function.prototype.bind=function(oThis){if(typeof this!=="function"){throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable")}
    var aArgs=Array.prototype.slice.call(arguments,1),fToBind=this,fNOP=function(){},fBound=function(){return fToBind.apply(this instanceof fNOP?this:oThis||window,aArgs.concat(Array.prototype.slice.call(arguments)))};fNOP.prototype=this.prototype;fBound.prototype=new fNOP();return fBound}}
    return Scratcher})()