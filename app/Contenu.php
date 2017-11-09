<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TaxonomyExtendedTrait;

use Auth;

class Contenu extends Model {
	use TaxonomyExtendedTrait;

	public static $catIdentite = ['objectifs', 'groupe_individuel', 'usage', 'theorique_pratique', 'discipline', 'thematique', 'niveau', 'format'];

	public static $catSiThematique = ['recommandation', 'profil'];
	//use \Devfactory\Taxonomy\TaxonomyTrait;

	protected $casts = [
		'score_upvote' => 'integer',
		'score_downvote' => 'integer',
		'score_avis' => 'float',

	];

	protected $guarded = ['id'];

	function liens()
	{
		return $this->hasMany('App\Lien');
	}

	public function commentaires()
    {
        return $this->hasMany('App\Commentaire');
    }

	function proposePar()
	{
		return $this->belongsTo('App\User', 'propose_par_id');
	}

	public function avis()
	{
		return $this->hasMany('App\Avis');
	}

	public function votes()
	{
		return $this->hasMany('App\Vote');
	}

	public function historiques()
	{
		return $this->hasMany('App\Historique');
	}

	public function historique($texte, $update_user_lastaction = true)
	{
		$this->historiques()->insert([
			'contenu_id' => $this->id,
			'date' => date('Y-m-d H:i:s'),
			'user_id' => (Auth::user()) ? Auth::user()->id : null,
			'text' => substr($texte,0,1000)
		]);

		if ($update_user_lastaction)
		{
			Auth::user()->recalculerNbContributions();
			//$user->save();
		}
	}

	public function termsIds()
	{
		return $this->related()->get()->pluck('term_id');
	}

	public static function etoiles($nb) {
			$html = "";
			for ($i = 1; $i <= $nb; $i++)
			{
            	$html .= "<span class='glyphicon glyphicon-star text-warning'></span>";
			}
			return $html;
	}

	public static function coeurs($nb = 1) {
			$html = "";
			for ($i = 1; $i <= $nb; $i++)
			{
            	$html .= "<span class='glyphicon glyphicon-heart text-danger'></span>";
			}
			return $html;
	}

	function player($w = null, $h = null)
	{

		switch ($this->decoder)
		{
			case 'youtube' :
				return view('players.youtube', [
					'url' => $this->embed_url,
					'w' => $w,
					'h' => $h
				])->render();

			default :
				$width =  ($w) ? 'width:' . $w . 'px;' : null;
				$height =  ($h) ? 'height:' . $h . 'px;' : null;
				$marginTop =  ($h) ? 'margin-top:' . (($h-46)/2) . 'px;' : null;
				$bgimg = ($this->image) ? 'background-image: url(' . $this->image . ')' : null;
				return '<div class="text-center player-image" style="' . $width . $height . $bgimg . '">
					<a href="' . $this->url . '" class="btn btn-primary btn-lg" target="_blank" style="' . $marginTop . '">Visualiser le contenu</a>
				</div>';
		}
	}

	function getImagesAttribute($images)
	{
		return (is_array($images)) ? $images : explode(',', $images);

	}

	/*function image()
	{
		return (!empty($this->images[0])) ? $this->images[0] : null;
	}*/

	function imageUrl($w = 0, $h = 0)
	{
		return str_replace('0x0', $w . 'x' . $h, $this->image);
	}

	function sauverImage($debug = false)
	{
		if ($this->images)
		{
			$images = $this->images;
			foreach ($images as $i => $image)
			{
				if ($i == 0)
				{
					if (!starts_with($image, env('APP_URL')))
					{
						$ImageController = new \App\Http\Controllers\ImageController;
						if (starts_with($image, '/')) {
							$image = env('APP_URL') . $image;
						}
						$response = $ImageController->saveImage($image,'c' . $this->id);
						if ($debug) dump($response);
						$local_image = (!empty($response['url'])) ? $response['url'] : $image;

					}
					else
					{
						$local_image = $image;
					}
				}
			}
			if (!empty($local_image))
			{
				$this->image = $local_image;
				//dd($this->images);
				$this->save();
			}
		}
		//die();
	}

	function url()
	{
		return action('ContenusController@voir', [$this->id, str_slug($this->titre)]);
	}

	function recalculerVotes()
	{
	    $this->oldRecalculerVotes();

		$notes = \DB::select('SELECT avg(note) as moyenne, count(note) as nb
			FROM votes
			WHERE contenu_id = ' . $this->id . ' AND note IS NOT NULL
			')
   			;
   			//dd($avis);
   		$this->note = (!empty($notes[0])) ? $notes[0]->moyenne : 0;
        $this->nb_votes = (!empty($notes[0])) ? $notes[0]->nb : 0;

        //dd( $this->votes()->sum('vote_down'));
		//dd($this);
		$this->save();
	}

    function oldRecalculerVotes()
    {
        $avis = \DB::select('SELECT avg(note_fond + note_forme + note_accessibilite + waouh) as moyenne
			FROM avis
			WHERE contenu_id = ' . $this->id . '
			')
        ;
        //dd($avis);
        $this->score_avis = (!empty($avis[0])) ? $avis[0]->moyenne/2 : 0;
        //dd( $this->votes()->sum('vote_down'));
        $this->score_upvote = $this->votes()->sum('vote_up');
        $this->score_downvote = $this->votes()->sum('vote_down');
        //dd($this);
        $this->save();
    }
}