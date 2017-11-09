<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evenement extends Model {

    protected $guarded = ['id'];


    public function auteur()
    {
        return $this->belongsTo('App\User');
    }

    public function interesses()
    {
        return $this->belongsToMany('App\User', 'evenements_interesses')->withTimestamps();
    }

    function url()
    {
        return action('EvenementsController@voir', [$this->id, str_slug($this->titre)]);
    }

    public function majNbInteresses()
    {
        $this->nb_interesses = $this->interesses()->count();
        $this->save();
        return $this->nb_interesses;
    }
}

