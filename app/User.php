<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Traits\TaxonomyExtendedTrait;

class User extends Authenticatable
{
    use Notifiable;
	use TaxonomyExtendedTrait;
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function historiques()
    {
		return $this->hasMany('App\Historique', 'user_id');
	}

	public function contenus()
	{
		return $this->hasMany('App\Contenu', 'propose_par_id');
	}

	public function avis()
	{
		return $this->hasMany('App\Avis', 'evaluateur_id');
	}

    public function role()
    {
		return $this->belongsTo('App\Role');
	}

	public function droits()
	{
		return $this->hasManyThrough('App\Droit', 'App\Role');
	}

	public function profils()
	{
		return $this->hasMany('App\Profil');
	}

	public function contenusParcourus()
	{
		return $this->belongsToMany('App\Contenu', 'parcours_utilisateurs');
	}

	public function contenusFavoris()
    {
        return $this->belongsToMany('App\Contenu', 'favoris', 'auteur_id')->withTimestamps();
    }

    public function interesseParEvenements()
    {
        return $this->belongsToMany('App\Evenement', 'evenements_interesses')->withTimestamps();
    }

    public function commentaires()
    {
        return $this->hasMany('App\Commentaire', 'auteur_id');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\User', 'user_contacts', 'user_id', 'contact_id')->withTimestamps();
    }

	public function possedeDroit($code)
	{
		if (empty($this->role_id)) return false;
		$droits = $this->droits();
		if (!$droits) return false;
		//dd($code);
		$droit = $this->role->droits()->where('code', $code)->first();
		//print_r(['droit' => $droit, 'code' => $code]);
		if (!empty($droit))
		{
			return true;
		}
		return false;
	}

	public static function possedantDroit($code)
	{
		$roles = Role::whereHas('droits', function($q) use ($code) {
			$q->where('code',$code);
		})->select('id')->get()->pluck('id');

		$users = User::whereIn('role_id', $roles)->get();
		return $users;
		//print_r($roles->toArray());
	}

    /**
    * Renvoie la liste des Droits dont dispose l'utilisateur (via son profil)
    *
    */
    public function droitsIds()
    {
    	$droitsIds = [];
    	if (!empty($this->role))
    	{
    		$droitsIds = $this->role->droitsRoles()->select('droit_id')->pluck('droit_id');
		}
		$droitsIds[] = 0;
		return $droitsIds;
	}

	public function peutSupprimerContenu($contenu)
	{
		if ($this->possedeDroit('supprimer_tous_contenus'))
		{
			return true;
		}
		if ($this->possedeDroit('supprimer_son_contenu') AND $this->id == $contenu->propose_par_id)
		{
			return true;
		}
		return false;
	}

	public function peutModifierContenu($contenu)
	{
		// Nouveau contenu
		if ($this->possedeDroit('proposer_contenu') AND !$contenu->id)
		{
			return true;
		}
		// Admin
		if ($this->possedeDroit('modifier_tous_contenus'))
		{
			return true;
		}
		// Auteur du contenu
		if ($this->possedeDroit('proposer_contenu') AND $this->id == $contenu->propose_par_id)
		{
			return true;
		}
		return false;
	}

	public function peutPublierContenu()
	{
		if ($this->possedeDroit('publier_contenu'))
		{
			return true;
		}
		return false;
	}

 	/**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function recalculerNbContributions()
    {
		$nb = $this->contenus()->whereIn('etat',['propose','evalue','publie'])->count() + $this->avis()->count();
		//if ($nb != $this->nb_contributions)
		//{
		$this->nb_contributions = $nb;

		$derniere_action = $this->historiques()->orderBy('date','desc')->first();
		if ($derniere_action)
		{
			$this->date_derniere_action = $derniere_action->date;
		}
		//}
		$this->save();
		return $this->nb_contributions;
	}

	public function urlPublique()
	{
		if ($this->public)
		{
			return action('MembresController@voir', ['id' => $this->id, 'nom' => str_slug($this->name)]);
		}
	}

	public function getImageAttribute($val)
	{
		return ($val) ? $val : '/img/membre.png';
	}

    public function majNbScore()
    {
        $nb = 0;
        $nb += $this->contenus()->count();
        $nb += $this->commentaires()->count();
        $nb += $this->interesseParEvenements()->count();
        $nb += $this->contenusFavoris()->count();
        $this->score = $nb;
        $this->save();
        return $this->score;
    }
}
