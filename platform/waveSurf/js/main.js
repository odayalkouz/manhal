'use strict';

// Create an instance
var currentRegion = "";
var wavesurfer = Object.create(WaveSurfer);

// Init & load audio file
$( document ).ready(function(){





    var options = {
        container: document.querySelector('#waveform'),
        waveColor: 'blue',
        progressColor: 'purple',
        loaderColor: 'green',
        cursorColor: 'navy',
        splitChannels: true,
    };

    if (location.search.match('scroll')) {
        options.minPxPerSec = 100;
        options.scrollParent = true;
    }

    if (location.search.match('normalize')) {
        options.normalize = true;
    }

    // Init
    wavesurfer.init(options);
    // Load audio from URL


  //  var urlSound = "../data/sound/" + parent.StoryPages[parent.Current].sound

    wavesurfer.load(urlSound);

    // Zoom slider
    var slider = document.querySelector('[data-action="zoom"]');


    slider.addEventListener('input', function () {

        wavesurfer.zoom(Number(this.value));
    });

    // Regions
    if (wavesurfer.enableDragSelection) {
        wavesurfer.enableDragSelection({
            color: 'rgba(0, 255, 0, 0.4)'
        });
    }


});

// Play at once when ready
// Won't work on iOS until you touch the page
wavesurfer.on('ready', function () {
    createSubtitle()
    wavesurfer.play();
    var timeline = Object.create(WaveSurfer.Timeline);
    timeline.init({
        wavesurfer: wavesurfer,
        container: "#wave-timeline"
    });


    //if (localStorage.regions) {
    //   loadRegions(JSON.parse(localStorage.regions));

    if (soundData.textAligner) {
        loadRegions(soundData.textAligner);


    } else {
        // loadRegions(
        //     extractRegions(
        //         wavesurfer.backend.getPeaks(512),
        //         wavesurfer.getDuration()
        //     )
        //);
        wavesurfer.util.ajax({
            responseType: 'json',
            url: 'annotations.json'
        }).on('success', function (data) {
           // loadRegions(data);
            //saveRegions();
        });
    }

    wavesurfer.on('region-click', function (region, e) {
        e.stopPropagation();
        // Play on click, loop on shift click
        e.shiftKey ? region.playLoop() : region.play();
        currentRegion = region.id
        // console.log(region.remove())
    });
    wavesurfer.on('region-click', editAnnotation);
    wavesurfer.on('region-updated', saveRegions);
    wavesurfer.on('region-removed', saveRegions);
    wavesurfer.on('region-in', showNote);

    wavesurfer.on('region-play', function (region) {
        region.once('out', function () {
            wavesurfer.play(region.start);
            wavesurfer.pause();
        });
    });


    /**
     * Save annotations to localStorage.
     */
    function saveRegions() {

        localStorage.regions = JSON.stringify(
            Object.keys(wavesurfer.regions.list).map(function (id) {
                var region = wavesurfer.regions.list[id];
                return {
                    start: region.start,
                    end: region.end,
                    attributes: region.attributes,
                    data: region.data,
                    color: randomColor(0.5),

                };
            })
        );
        resortArrayShow()
        ExportToCurrentStory()
    }


    /**
     * Load regions from localStorage.
     */
    function loadRegions(regions) {
        if (regions.length == 0)
            return
        regions.forEach(function (region) {
            region.color = randomColor(0.5);
            console.log(region)
            wavesurfer.addRegion(region);
        });
    }


    /**
     * Extract regions separated by silence.
     */
    function extractRegions(peaks, duration) {
        // Silence params
        var minValue = 0.0015;
        var minSeconds = 0.25;

        var length = peaks.length;
        var coef = duration / length;
        var minLen = minSeconds / coef;

        // Gather silence indeces
        var silences = [];
        Array.prototype.forEach.call(peaks, function (val, index) {
            if (Math.abs(val) <= minValue) {
                silences.push(index);
            }
        });

        // Cluster silence values
        var clusters = [];
        silences.forEach(function (val, index) {
            if (clusters.length && val == silences[index - 1] + 1) {
                clusters[clusters.length - 1].push(val);
            } else {
                clusters.push([val]);
            }
        });

        // Filter silence clusters by minimum length
        var fClusters = clusters.filter(function (cluster) {
            return cluster.length >= minLen;
        });

        // Create regions on the edges of silences
        var regions = fClusters.map(function (cluster, index) {
            var next = fClusters[index + 1];
            return {
                start: cluster[cluster.length - 1],
                end: (next ? next[0] : length - 1)
            };
        });

        // Add an initial region if the audio doesn't start with silence
        var firstCluster = fClusters[0];
        if (firstCluster && firstCluster[0] != 0) {
            regions.unshift({
                start: 0,
                end: firstCluster[firstCluster.length - 1]
            });
        }

        // Filter regions by minimum length
        var fRegions = regions.filter(function (reg) {
            return reg.end - reg.start >= minLen;
        });

        // Return time-based regions
        return fRegions.map(function (reg) {
            return {
                start: Math.round(reg.start * coef * 10) / 10,
                end: Math.round(reg.end * coef * 10) / 10
            };
        });
    }


    /**
     * Random RGBA color.
     */


    /**
     * Edit annotation for a region.
     */
    function editAnnotation(region) {

        var form = document.forms.edit;
        form.style.opacity = 1;
        form.elements.start.value = Math.round(region.start * 10) / 10,
            form.elements.end.value = Math.round(region.end * 10) / 10;
        form.elements.note.value = region.data.note || '';
        form.onsubmit = function (e) {
            e.preventDefault();
            region.update({
                start: form.elements.start.value,
                end: form.elements.end.value,
                data: {
                    note: form.elements.note.value
                }
            });
            form.style.opacity = 0;
        };
        form.onreset = function () {
            form.style.opacity = 0;
            form.dataset.region = null;
        };
        form.dataset.region = region.id;
    }


    /**
     * Display annotation.
     */
    function showNote(region) {
        if (!showNote.el) {
            showNote.el = document.querySelector('#subtitle');
        }
        showNote.el.textContent = region.data.note || '';


        $('.sortingArrayShowinner span').each(function () {

            if ($(this).attr("id") == region.id) {
                $(".liSortingg ").css('color', 'black')
                $(this).css('color', '#00AB67')

            }

        })
    }

    wavesurfer.params.container.style.width = "100%";
    wavesurfer.on('pause', function () {
        wavesurfer.params.container.style.opacity = 0.9;
    });

    wavesurfer.on('play', function () {
        wavesurfer.params.container.style.opacity = 1;
    });

    resortArrayShow()
});

// Report errors
wavesurfer.on('error', function (err) {
    console.error(err);
});

// Do something when the clip is over
wavesurfer.on('finish', function () {
    console.log('Finished playing');
});


/* Progress bar */
$( document ).ready(function(){

    var progressDiv = document.querySelector('#progress-bar');
    var progressBar = progressDiv.querySelector('.progress-bar');

    var showProgress = function (percent) {
        progressDiv.style.display = 'block';
        progressBar.style.width = percent + '%';
    };

    var hideProgress = function () {
        progressDiv.style.display = 'none';
    };

    wavesurfer.on('loading', showProgress);
    wavesurfer.on('ready', hideProgress);
    wavesurfer.on('destroy', hideProgress);
    wavesurfer.on('error', hideProgress);

    createGrid(50)
});


// Drag'n'drop
$( document ).ready(function(){
    var toggleActive = function (e, toggle) {
        e.stopPropagation();
        e.preventDefault();
        toggle ? e.target.classList.add('wavesurfer-dragover') :
            e.target.classList.remove('wavesurfer-dragover');
    };

    var handlers = {
        // Drop event
        drop: function (e) {
            toggleActive(e, false);

            // Load the file into wavesurfer
            if (e.dataTransfer.files.length) {
                wavesurfer.loadBlob(e.dataTransfer.files[0]);
            } else {
                wavesurfer.fireEvent('error', 'Not a file');
            }
        },

        // Drag-over event
        dragover: function (e) {
            toggleActive(e, true);
        },

        // Drag-leave event
        dragleave: function (e) {
            toggleActive(e, false);
        }
    };

    var dropTarget = document.querySelector('#demo');
    Object.keys(handlers).forEach(function (event) {
        dropTarget.addEventListener(event, handlers[event]);
    });
});

function removeRegions() {

    swal({
            title: "هل انت متأكد ؟",
            text: "سيتم حذف منطقة الربط الحاليه ؟",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "نعم",
            cancelButtonText: "لا",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                wavesurfer.regions.list[currentRegion].remove()
                var form = document.forms.edit;
                form.style.opacity = 0;
                swal("حذف الملف", "تم الخذف بنجاح", "success");
            }
            else {
                swal("تم الالغاء", "", "error");
            }
        });


}


function randomColor(alpha) {
    return 'rgba(' + [
            ~~(Math.random() * 255),
            ~~(Math.random() * 255),
            ~~(Math.random() * 255),
            alpha || 1
        ] + ')';

}


function removeAllRegions() {

    swal({
            title: "هل انت متأكد ؟",
            text: "سيتم حذف كل مناطق الصوت المربوطه مع النصوص !",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "نعم",
            cancelButtonText: "لا",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                Object.keys(wavesurfer.regions.list).map(function (id) {
                    wavesurfer.regions.list[id].remove();

                })
                swal("حذف الملف", "تم الخذف بنجاح", "success");
            }
            else {
                swal("تم الالغاء", "", "error");
            }
        });


}


function createGrid(size) {
    //console.log("ddddd")
    //var ratioW = Math.floor($(window).width()/size),
    //    ratioH = Math.floor($(window).height()/size);
    //
    //
    //
    //for (var i = 0; i < ratioH; i++) {
    //    for(var p = 0; p < ratioW; p++){
    //        $('<div />', {
    //            width: size - 1,
    //            height: size - 1
    //        }).appendTo('.waveformGrid');
    //    }
    //}
}

var newArrayAfterSorting = []

function resortArray() {
    newArrayAfterSorting.length = 0
    var arraySorting = Object.keys(wavesurfer.regions.list).map(function (id) {
        var region = wavesurfer.regions.list[id];
        return {
            start: region.start,
            end: region.end,
            attributes: region.attributes,
            data: region.data,
            color: randomColor(0.5),
            id:id
        };
    })


    $('.sorting-popup-main').show()
    $('.sorting').html('').show()


    for (var i = 0; i < arraySorting.length; i++) {


            $('<li IDarea="' + arraySorting[i].id + '" class="liSorting" index="' + i + '">' + arraySorting[i].data.note + '' +
                '<a type="button"  index="' + arraySorting[i].id + '" onclick="removeFromArray(this)" style=""><i class="flaticon-close"></i></a></li>').appendTo('.sorting')

    }

    $(".sorting").sortable();
    $(".sorting").disableSelection();

   // var linkOrderData = $(".sorting").sortable('serialize');

}


function SortingNow() {
var newArrayStoring=[]
$('.sorting').find('li').each(function(index){

    newArrayStoring.push(wavesurfer.regions.list[$(this).attr('IDarea')])
    console.log(wavesurfer.regions.list[$(this).attr('IDarea')].data.note)
})

   StoryPages.textAligner=newArrayStoring.slice();
    wavesurfer.regions.list=newArrayStoring.slice();
    swal("تم الحقظ", "", "success");
    ExportToCurrentStory();
    window.doReload=true;
   // setTimeout( location.reload(),2000)


}
var currntOFsorting=0
function removeFromArray(object){
 currntOFsorting=$(object).attr('index')
    swal({
            title: "هل انت متأكد ؟",
            text: "سيتم حذف منطقة الربط الحاليه ؟",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "نعم",
            cancelButtonText: "لا",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {

        wavesurfer.regions.list[currntOFsorting].remove()
                resortArray()
                var form = document.forms.edit;
                form.style.opacity = 0;
                swal("حذف الملف", "تم الخذف بنجاح", "success");
            }
            else {
                swal("تم الالغاء", "", "error");
            }
        });
}

function closeSortWord(){
    //if ($('.sorting-popup-main').length)$('.sorting-popup-main').remove()
    $('.sorting-popup-main').hide();
}



function resortArrayShow() {
    newArrayAfterSorting.length = 0
    var arraySorting = Object.keys(wavesurfer.regions.list).map(function (id) {
        var region = wavesurfer.regions.list[id];
        return {
            start: region.start,
            end: region.end,
            attributes: region.attributes,
            data: region.data,
            color: randomColor(0.5),
            id:region.id
        };
    })


    //$('.sorting-popup-main').show()
    $('.sortingArrayShowinner').html('')

console.log(arraySorting)
    for (var i = 0; i < arraySorting.length; i++) {


        $('<span id="'+arraySorting[i].id+'" IDarea="' + arraySorting[i].id + '" class="liSortingg" index="' + i + '">' + arraySorting[i].data.note + '' +
            '</span>').appendTo('.sortingArrayShowinner')

    }

    //$(".sorting").sortable();
    //$(".sorting").disableSelection();

    // var linkOrderData = $(".sorting").sortable('serialize');

}