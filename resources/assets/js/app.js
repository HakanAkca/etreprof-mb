
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery-bar-rating');
require('./vue')
require('./moment')
require('select2')
window.marked = require('marked');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('modal-container', require('./components/ModalContainer.vue'));
Vue.component('feedback-button', require('./components/FeedbackButton.vue'));
Vue.component('feedback-modal', require('./components/FeedbackModal.vue'));
//Vue.component('feedback-modal', '<div>ok</div>');

$(function() {
	/*$('.logout').click(function(e) {		
		$.post('/logout', { '_token' : $('input[name="_token"]').val() }, function() {
			window.location = '/login';
		});
	});*/
	
	const feedbackVue = new Vue({
	    el: '#feedbackVue'
	});

});


