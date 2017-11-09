"use strict";

const urlBuilder = require('url');

exports.json = function(html,$, url) {
	var o = {
		'decoder' : 'default',
		'length' : html.length
	};
	o.titre = $('title').text();
	o.description = $('meta[name="description"]').attr('content');
	o.images = [$('meta[property="og:image"]').attr('content')];

	var baseHref = (baseHref = $('base').attr('href')) ? baseHref : url;
	let images = $('img').map(function() { 
		if (baseHref && $(this).attr('src')) return urlBuilder.resolve(baseHref, $(this).attr('src')); 
		//console.log('Erreur baseHref, url :', baseHref, $(this).attr('src'));
	}).get();
	if (images) {
		o.images = o.images.concat(images);
	}
	o.images = o.images.filter(function(item, pos) {
	    return o.images.indexOf(item) == pos;
	})

	var tags = $('meta[property="article:tag"]');
	if (tags.length) {
		//console.log(tags);
		o.tags = $(tags).map(function() { return $(this).attr('content') }).get().join(',');
	}


	return o;
}
