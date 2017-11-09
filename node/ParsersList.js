"use strict";

exports.find = function(url, html) {

	if (url.match(/http:\/\/www\.commentreparer\.com.*/)) {
		var Parser = require('./Parsers/Test');
		//console.log('CommentReparer');
	}
	else if (url.match(/.*youtube/) && !url.match(/user/)) {
		var Parser = require('./Parsers/Youtube');
		//console.log('Youtube');
	}
	else {
		var Parser = require('./Parsers/Default');
		//console.log('Default');
	}


	 require("jsdom").env(html, function(err, window) {
		if (err) {
			console.error(err);
			return;
		}
		//var $ = require("jquery")(window);
		var $ = require("jquery")(window);


		//console.log(html.length);
		//console.log($('img').attr('src'));
		var json = JSON.stringify(Parser.json(html,$,url));
		console.log(json);
	});

};