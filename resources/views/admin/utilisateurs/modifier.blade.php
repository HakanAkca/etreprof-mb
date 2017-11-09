@extends('admin.layout')


@section('content')

<h1>{{ $user->name }}</h1>
{!! Form::model($user, ['class' => 'form-horizontal']) !!}
<div id="vue" class="row">

	<div class="col-sm-7">


		{!! csrf_field() !!}

			<fieldset>
				<legend>Compte utilisateur</legend>

				@include('form.element', [ 'element' => [
					'Pseudo',
					Form::text('name', null, [
					'class' => 'form-control',
					'placeholder' => ""
					])
				]])

				@include('form.element', [ 'element' => [
					'E-mail',
					Form::text('email', null, [
					'class' => 'form-control',
					'placeholder' => ""
					])
				]])

				@include('form.element', [ 'element' => [
					'Profil',
					Form::select('role_id', $roles, null, [
					'class' => 'form-control',
					'placeholder' => ""
					])
			 	]])

			 	<h2>Profil public</h2>

				@include('form.element', [ 'element' => [
					'Le profil de cet utilisateur est visible :',
					'<label>' . Form::radio('public', 0, null, [
					'class' => '',
					]) . 'NON : profil privé</label> &nbsp; &nbsp;
					<label>' . Form::radio('public', 1, null, [
					'class' => '',
					]) . 'OUI : profil public</label>'
			 	]])

				@include('form.element', [ 'element' => [
					'Image (possibilité d\'utiliser un lien externe http://)',
					Form::text('image', null, [
					'class' => 'form-control ckeditor',
					'placeholder' => "http://"
					])
			 	]])

			 	<h2>Bonus Profil</h2>
				<p>Vous pouvez saisir un score de bonus/malus (ex. -5, 2, 12...) pour modifier le profil dominant de cet utilisateur. Cela modifiera les recommandations qui lui sont proposées.</p>
				@foreach (App\Profil::question('enseigner')['reponses'] as $key => $val)
					@include('form.element', [ 'element' => [						
					'' . $val . ((!empty($scoresProfils->get($key))) ? ' <span class="label label-info">' . $scoresProfils->get($key)->score . '</span>' : ''),
					Form::number('bonus_admin[' . $key . ']', ((!empty($user->bonus_admin[$key])) ? $user->bonus_admin[$key] : 0), [
					'class' => 'form-control ckeditor',
					'placeholder' => ""
					])
			 	]])
				@endforeach

			</fieldset>


			<div class="text-center">
				<input type="submit" class="btn btn-lg btn-primary" value="Enregistrer les modifications">
			</div>



		</div>

		<div class="col-sm-5">
			<div class="well">
				<p>Inscrit·e le {{ Date::parse($user->created_at)->format('j F Y H:i') }} <a href="https://clicky.com/stats/visitors?site_id=101040726&date=last-28-days&custom[email]={{ $user->email }}" target="_blank"><span class="glyphicon glyphicon-stats"></span> Stats</a></p>

				<h3>Niveaux </h3>
				@foreach ($termes as $related)
					<big><span class="label label-warning">{{ $related->term->name }}</span></big>
				@endforeach

				@if (!empty($dominante))
						<h3>
						<strong>Profil dominant : </strong>
						{{ $dominanteTermes->implode('name', '+') }} <span class="label label-info">{{ $dominante->score }}</span>
						</h3>
				@endif
				<ul>
				@foreach ($profils as $profil)
					@if ($profil->question == 'bonus_admin') @continue @endif
					<li><strong>{{ App\Profil::question($profil->question)['question'] }}</strong> : {{ $profil->reponse_texte }} @if ($profil->score) <span class="label label-info"> {{ $profil->score }} </span> @endif</li>
				@endforeach
				</ul>

			</div>
		</div>
		{!! Form::close() !!}
	</div><!-- #vue -->

	<fieldset>
	@include('admin.utilisateurs.historique')
	</fieldset>

@endsection