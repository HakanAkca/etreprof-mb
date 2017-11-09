Vue.filter('truncate', function(string,length) {
	if (string.length < length-2) return string;
	return jQuery.trim(string).substring(0, length)
    .split(" ").slice(0, -1).join(" ") + "...";
})