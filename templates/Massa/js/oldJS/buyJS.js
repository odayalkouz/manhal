function requestItemsToBuy(fileURlDownload, folderNameRoot, indexNumberAlias) {
// content download


    //store.register({
    //    id:    'intelligentst'+indexNumberAlias, // id without package name!
    //    alias: 'story'+indexNumberAlias,
    //    type:   store.NON_CONSUMABLE
    //});


  downloadFileFromTo(fileURlDownload, folderNameRoot,indexNumberAlias);


//alert('intelligentst'+indexNumberAlias)


    //   store.once("story"+indexNumberAlias).approved(function (product) {
    //
    //
    //
    //
    //          // product.verify();
    //           downloadFileFromTo(fileURlDownload, folderNameRoot,product);
    //
    //
    //
    //
    //
    //   });
    //
    //   // Show progress during hosted content download
    //   store.once("story"+indexNumberAlias).downloading(function(product) {
    //
    //       var html = 'Downloading content';
    //       if(product.progress >= 0){
    //           html += ': ' + product.progress + '%';
    //       }
    //     //  document.getElementById('non-consumable-non-hosted-content-download').innerHTML = html;
    //   });
    //
    //   // When hosted content download is complete, finish the transaction
    //   store.once("story"+indexNumberAlias).downloaded(function(product) {
    //
    //       alert('تمت العملية بنجاح ')
    //       product.finish();
    //       product.set("state", store.OWNED);
    //   });
    //
    //
    //
    //
    //
    //store.refresh();
    //
    //
    //   store.ready(function() {
    //
    //
    //
    //           store.order('intelligentst'+indexNumberAlias);
    //
    //
    //
    //   });


}


