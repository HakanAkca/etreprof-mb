"use strict";
var http = require('follow-redirects').http,
	https = require('follow-redirects').https,
    ParsersList = require('./ParsersList'),
    urlParser = require('url');



exports.fetch = function(url) {

	//console.log(url);
	var protocol = (url.substring(0,5) == 'https') ? https : http;
	var urlDecoded = urlParser.parse(url);
	//console.log(urlDecoded);
	//return;
	var options = {
		protocol: urlDecoded.protocol,
		host: urlDecoded.host,
		path: urlDecoded.path,

  		headers: {
  			'Accept' : 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
			/*'Accept-Encoding' : 'gzip, deflate, sdch',*/
			'Accept-Language' : 'fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4',
			'Cache-Control' : 'no-cache',
			'Connection' : 'keep-alive',
			'Cookie' : '_AVESTA_ENVIRONMENT=prod',
			'DNT' : 1,
			'Pragma' : 'no-cache',
			'Upgrade-Insecure-Requests' : 1,
			'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'

		}
	};
	//console.log(options);
	protocol.get(options, function(res) {
		const statusCode = res.statusCode;
		const contentType = res.headers['content-type'];

		//console.log(res.responseUrl);

		  let error;
		  if (statusCode !== 200) {
			error = new Error(`Request Failed.\n` +
						      `Status Code: ${statusCode}`);
		  }/* else if (!/^application\/json/.test(contentType)) {
			error = new Error(`Invalid content-type.\n` +
						      `Expected application/json but received ${contentType}`);
		  }*/
		  if (error) {
			console.log(error.message);
			console.log(res);
			// consume response data to free up memory
			res.resume();
			return;
		  }

		  res.setEncoding('utf8');
		  let rawData = '';
		  res.on('data', (chunk) => rawData += chunk);
		  res.on('end', () => {
			try {
			    //console.log(rawData);
				//console.log(contentType);
				if (contentType.trim().substring(0,9) == 'text/html') {
					ParsersList.find(url,rawData);
				} else {
					console.log(JSON.stringify({
						'url' : url,
						'decoder' : contentType,
						'images' : (contentType.substring(0,5) == 'image') ? [url] : [],
						'length' : res.length
					}));
				}

			  /*let parsedData = JSON.parse(rawData);
			  console.log(parsedData);*/
			} catch (e) {
			  console.log(e.message);
			}
		  })
	});
	/*$.get(url,function(data) {
	  console.log(data);
	});*/

}
;

//module.exports(Fetcher);