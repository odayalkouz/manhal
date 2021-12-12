lastClick = {
    cat: "alphabet",


}
LibraryFolderName = ['arabicletter','bra3mAl3rabieh','shape', 'alphabet','animal', 'education', 'faces', 'people', 'social', 'symbole', 'tools', 'Stamps']
LibraryThumbName = [
    '../games/images/symbols/arabicletter/ManhalImages_01.svg',
    '../games/images/symbols/bra3mAl3rabieh/ManhalImages__01.svg',
    '../games/images/symbols/shape/octagon_1.png',
    '../games/images/symbols/alphabet/alphabet1.png',
    '../games/images/symbols/animal/conejo.png',
    '../games/images/symbols/education/edu11.png',
    '../games/images/symbols/faces/faces12.png',
    '../games/images/symbols/people/people10.png',
    '../games/images/symbols/social/social11.png',
    '../games/images/symbols/symbole/symbole28.png',
    '../games/images/symbols/tools/tools9.png',
    '../games/images/symbols/Stamps/pass.png',
]

function createThumbs() {

    strContainer = '<div class="libraryContainer"><div class="libraryClass2">' +
        '<div class="headerFileInput2"><label>Library</label>' +
        '<a class="library-close" onclick="removeLibraryBox()"><i></i></a>' +
        '</div>' +
        '<div class="libraryWrpper">' +

        '<div class="category floating-left">' +

        '' +
        '' +
        '</div>' +
        '<div class="contentCatg infinite-scroll floating-left">' +
        '' +
        '' +
        '</div>' +
        '</div>' +
        '<div class="library-footer">' +
        '<a class="ok-btn floating-right"><i></i></a>' +
        '</div>' +
        '</div>' +

        '</div>'
    $(strContainer).appendTo('body')
    for (var i = 0; i < LibraryFolderName.length; i++) {
        strPath = "'" + LibraryFolderName[i] + "'"

        $('<div id="Category_id_' + LibraryFolderName[i] + '" class="categoryObject hvr-push " onclick="LoadLibrary(' + strPath + ')"><img src="' + LibraryThumbName[i] + '"></div>').appendTo('.category')
    }


    $('#Category_id_alphabet').click()


}


function removeLibraryBox() {
    if ($('.libraryContainer').length) {
        $('.libraryContainer').remove()
    }
}

function LoadLibrary(path) {

    strPath = '../games/images/symbols/' + path + '/file.txt'
    path = '../games/images/symbols/' + path + '/'
    $.get(strPath, function (data) {
        $('.contentCatg').html('').hide().show('fast')

        cardRules = data.split('\n');

        showContenet(path, cardRules)
    });

}


function showContenet(path, arrayFiles) {

    for (var i = 0; i < arrayFiles.length; i++) {
        pathSrc = path + arrayFiles[i].replace('\n', "").replace('\r', "")

        nameFile = "'" + arrayFiles[i].replace('\n', "").replace('\r', "") + "'"
        $('<div class="imagesContenet hvr-push hvr-outline-in" onclick="UploadobjectLibrary(this)">' +
            '<img src="' + pathSrc + '">' +
            '' +
            '' +
            '</div>').appendTo('.contentCatg')


    }


}


function UploadobjectLibrary(object) {
    pathSrc = $(object).find('img').attr('src')
   
    array = (pathSrc.split('/'))
    name = array[array.length - 1]
    extension=getExtension(name)
  
    ajaxPHP(pathSrc, "", "CopyFile", "col_" +miniEdittor.dir+miniEdittor.activeIndex+ "."+extension, "Library",config.rootPath + "/all/images/" + "col_" +miniEdittor.dir+miniEdittor.activeIndex+ "."+extension)
}