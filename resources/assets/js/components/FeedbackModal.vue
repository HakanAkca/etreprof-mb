<template>
<div>
	
	<div v-if="!done">
		<h2>Votre retour est important.</h2>
		<p>Donnez-nous votre avis pour améliorer ce site.</p>
		<form method="post" :action="url" @submit.prevent="submit()">
			<label>Votre remarque/commentaire : </label>
			<textarea name="feedback" class="form-control" v-model="feedback" required="true">

			</textarea>

			<input type="submit" class="btn btn-lg btn-primary pull-right" :value="submitLabel">
			<div class="clearBoth"></div>
		</form>
	</div>
	<div v-if="done">
		<h2>Merci !</h2>
		<p>L'équipe va rapidement prendre connaissance de votre retour et si besoin vous recontactera.</p>
	</div>
</div>
</template>

<script>
var data = {
	url: '/feedback',
	done: 0,
	feedback: '',
	submitLabel: 'Envoyer',
	loadingLabel: '... patientez'
};

export default {
	 data() {
        return data
    },

    methods: {
    	submit: function() {
    		//alert('ok');
    		//if (e) e.preventDefault()
    		
    		var self = this;
    		self.submitLabel = data.loadingLabel;
    		
    		$.post(this.url, { 'feedback' : this.feedback, _token: $('input[name="_token"]').val() })
    			.done(function() {
    				self.done = 1;
    				self.submitLabel = data.submitLabel;
    			});
    		//return false;
    	}
    }
}
</script>