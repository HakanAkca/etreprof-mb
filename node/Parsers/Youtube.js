"use strict";


exports.json = function(html,$,url) {
	var o = {
		'decoder' : 'youtube',
		'length' : html.length
	};
	o.titre = $('title').text();
	o.description = $('meta[name="description"]').attr('content');
	o.images = $('meta[property="og:image"]').attr('content');
	o.embed_url = $('meta[property="og:video:url"]').attr('content');
	var tags = $('meta[property="og:video:tag"]');
	if (tags.length) {
		//console.log(tags);
		o.tags = $(tags).map(function() { return $(this).attr('content') }).get().join(',');
	}
	let duree = $('meta[itemprop="duration"]').attr('content');
	if (duree) {
		o.duree_secondes = YTDurationToSeconds(duree);
	}
	o.auteur = $('.yt-user-info').text().trim();
	o.source_url = 'https://www.youtube.com' + $('.yt-user-info a').attr('href');

	return o;
}

function YTDurationToSeconds(duration) {
  var match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/)

  var hours = (parseInt(match[1]) || 0);
  var minutes = (parseInt(match[2]) || 0);
  var seconds = (parseInt(match[3]) || 0);

  return hours * 3600 + minutes * 60 + seconds;
}