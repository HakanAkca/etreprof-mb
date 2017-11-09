<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use Date;
use Cache;

class Article extends Model {

    protected $fillable = ['title','content','excerpt','author_id','url','date','type','status','thumbnail', 'embed', 'featured'];

    public static $rules = [
	    'title' => 'required',
    ];

    public static $_status = [
        'published' => 'Publié',
        'archive' => 'Archivé',
        'draft' => 'Brouillon',
        'trash' => 'Corbeille',
    ];

    public static $_typeNames = [
		'post' => 'Articles',
		'page' => 'Pages',
		'block' => 'Blocs',
		'theme' => 'Dossiers',
		'custom' => 'Autres contenus',
    ];
    public static $_typeSlugs = [
		'post' => 'article',
		'page' => 'page',
		//'block' => 'bloc',
		'theme' => 'dossier',
		//'custom' => 'contenu',
    ];


    public function author()
    {
        return $this->belongsTo('User');
    }

    public function scopePublished($query)
    {
        return $query->where('status','published');
    }


	public function typeNom()
	{
		return self::$_typeNames[$this->type];
	}

	public static function getBlocks($urls)
	{
		$blocks = self::where('type', 'block')
					  ->whereIn('url', $urls)
					  ->get()
					  ->keyBy('url');

		foreach ($urls as $url) {
			if (empty($blocks[$url]))
			{
				$block = Article::create([
					'url' => $url,
					'title' => 'Bloc ' . $url,
					'type' => 'block',
					'date' => Date::now(),
					'author_id' => 0,
					'content' => '',
					'excerpt' => '',
					'thumbnail' => '',
				]);
				$blocks[$url] = $block;
			}
		}
		return $blocks;
	}

	public static function createBlock($url, $title)
	{
		$block = Article::create([
					'url' => $url,
					'title' => ($title) ? $title : 'Bloc ' . $url,
					'type' => 'block',
					'date' => Date::now(),
					'author_id' => 0,
					'content' => ($title) ? $title : 'Bloc ' . $url,
					'excerpt' => '',
					'thumbnail' => '',
				]);
		//dump($block);
		Cache::forget('blocs');
		return $block;
	}

    public function getUrl()
    {
    	if (isset($this->url) && isset(self::$_typeSlugs[$this->type]))
    	{
        	return '/' . self::$_typeSlugs[$this->type] . '/' . $this->url;
		}
    }

    public function getHtmlAttribute()
    {
    	$html = $this->content;

    	$user = (Auth::user()) ? Auth::user() : new User;

    	$html = str_replace(
			['{membre.pseudo}'],
			[ $user->name ],
			$html
    	);

		return $html;
	}

    public function getThumbnailUrl($format = 'thumb-medium')
    {
        $url = preg_replace('@cache/[a-z-A-Z0-9-_]+/@U','upload/', $this->thumbnail);
        return str_replace('/upload', '/cache/' . $format, $url);
    }
}

