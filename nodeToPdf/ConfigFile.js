var page = new WebPage();

page.paperSize = {
    format: "A4",
    orientation: "portrait",
    width: '15in',
    height: '18in',
    margin: {left: "2.5cm", right: "2.5cm", top: "2.5cm", bottom: "2.5cm"},
    footer: {
        height: "1cm",
        contents: phantom.callback(function (pageNum, numPages) {
            return ("Mon footer : " + pageNum + " / " + numPages);
        })
    }
};

page.open("http://etreprof.dev/diagnostic/html-pour-pdf", function (status) {

    var file = Math.random().toString(36).substring(7) + '.pdf';

    page.render(file, {quality: '100'});
    /*console.log(JSON.stringify({
     'success': 1,
     'file': file
     }));*/
    phantom.exit();
});