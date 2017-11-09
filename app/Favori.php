<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TaxonomyExtendedTrait;

use Auth;

class Favori extends Model {


    protected $guarded = ['id'];

    public function contenu()
    {
        return $this->belongsTo('App\Contenu');
    }

    public function auteur()
    {
        return $this->belongsTo('App\User');
    }
}