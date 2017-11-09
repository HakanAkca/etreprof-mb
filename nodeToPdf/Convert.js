"use strict";

var path = require('path');

var phantom = require('phantom');

var phInstance = null;
var file = null;
var basepath = path.resolve(__dirname + '/../');
var folder = 'storage/pdf/';
var url = process.argv[2];

phantom.create([], {
    phantomPath: basepath + '/node_modules/phantomjs/bin/phantomjs',
    //logLevel: 'debug',
})
    .then(function (instance) {
        phInstance = instance;
        return instance.createPage();
    })

    .then(function (page) {
        //console.log('page', page);

        page.property('paperSize', {
            width: '21cm', height: '29.7cm',
            margin: '2cm',
        });
        page.open(url)

            .then(function (status) {
                file = Math.random().toString(36).substring(7) + '.pdf';

                page.render(basepath + '/' + folder + file, {quality: '100'})
                    .then(function () {
                        console.log(JSON.stringify({
                            'success': 1,
                            'file': folder + file
                        }));
                        phInstance.exit();
                    })
            });
    });

