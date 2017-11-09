@extends('admin.layout')


@section('content')

	<h1>Membres</h1>

	<div id="vue">
		<table class="table table-striped">

		<tr>
			<th>1ère visite</th>
			<th>Dernière action</th>
			<th>Pseudo</th>
			<th>Profil</th>
			<th>Nombre de pages vues</th>
			<th>Nombre de recherches</th>

			<th>Statut</th>
		</tr>

		<tr v-for="membre in membres" :class="">
			<td>@{{membre.created_at }}</td>
			<td>@{{membre.updated_at }}</td>
			<td><strong><a v-bind:href="'/admin/utilisateurs/modifier/' + membre.id">@{{membre.name }}</a></strong></td>
			<td>@{{ (membre.role) ? membre.role.nom : '-' }}</td>

			<td></td>
			<td></td>
			<td><strong><a v-bind:href="'/admin/utilisateurs/modifier/' + membre.id" class="btn btn-sm btn-primary">Modifier</a></strong></td>

		</tr>

		</table>
	</div>

	<script>
	var vue = new Vue({
		 el: '#vue',
		 created: function() {
		 	this.getData();
		 },

		 methods: {
		 	getData: function() {
		 		var q = {};
				$.getJSON('/admin/utilisateurs/liste.json', q)
					.then(function(data) {
						if (typeof(data.users) != 'undefined') {
							vue.$data.membres = data.users.map(function(i) {
								return i;

							});
						}
						console.log(data);
					});
			}

		 },
		 data : {
		 	membres : []
		 }

	});
	</script>

@endsection