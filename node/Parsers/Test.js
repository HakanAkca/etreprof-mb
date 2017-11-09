"use strict";


exports.json = function(html,$) {
	var o = {};
	o.titre = $('title').first().text();

	return o;
}