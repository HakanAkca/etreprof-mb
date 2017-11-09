<?php
namespace App;

use Elasticsearch\ClientBuilder;
use Devfactory\Taxonomy\Models\Vocabulary;

use Auth;

class Search {

	public static $client;
	public static $index;

	/*public static $categories = [
		11 => 'discipline',
		12 => 'thematique',
		13 => 'niveau',
		14 => 'format',
		15 => 'categories'
	];*/

	function __construct()
	{
		if (empty(self::$client))
		{
			self::initIndices();
			self::$index = env('ELASTIC_SEARCH_INDEX');
		}
	}

	function initIndices()
	{
		$clientBuilder = ClientBuilder::create();
		$clientBuilder->setHosts(explode(',', env('ELASTIC_SEARCH_HOSTS')));
		self::$client = $clientBuilder->build();
	}
/*
	function existeContenu($id)
	{
		$params = [
		    'index' => self::$index,
		    'type' => 'contenu',
		    'id' => $id
		];

		// Delete doc at /my_index/my_type/my_id
		$response = self::$client->get($params);
		dump($response);
		return $response;
	}
	*/
	function viderIndexContenu()
	{
		$params = ['index' => self::$index];
		$exists = self::$client->indices()->exists($params);
		if  ($exists)
		{
			try {
				$response = self::$client->indices()->delete($params);
				dump(['viderContenu', 'response' => $response]);
				return $response;
			}
			catch (\Exception $e)
			{
				dump($e->getMessage());
			}
		}
		else
		{
			dump('Aucun index à supprimer');
		}
	}

	function rebuildIndexContenu()
	{
		//$client = ClientBuilder::create()->build();

		
		$fichier_synonymes = file(resource_path('search-data/synonymes.csv'));
		$synonymes = [];
		foreach ($fichier_synonymes as $ligne)
		{
			$array = array_filter(explode(',', trim($ligne)));
			if (count($array) > 1)
			{
				$synonymes[] = join(',',$array);
			}
		}
		//dd($synonymes);
		$params = [
		    'index' => self::$index,
		    'body' => [
		    	"settings" => [
				    "analysis" => [
				      "filter" => [
				      	"french_elision" => [
				          "type" => "elision",
				          "articles_case" => true,
				          "articles" => [
				              "l", "m", "t", "qu", "n", "s",
				              "j", "d", "c", "jusqu", "quoiqu",
				              "lorsqu", "puisqu"
				            ]
				        ],
				      	"french_stop" => [
				          "type" => "stop",
				          "stopwords" => "_french_" 
				        ],
				        "my_synonym_filter" => [
				          "type" => "synonym",
				          "synonyms" => $synonymes
				        ],
				        "french_stemmer" => [
		                    "type" => "stemmer",
		                    "name" => "french"
		                ]
				      ],
				      "analyzer" => [
				        "default" => [
				          "tokenizer" => "standard",
				          "filter" => [
				          	"french_elision",
				            "lowercase",
				            "my_synonym_filter",
				            "asciifolding",
				            "french_stop",
				            "french_stemmer"
				          ]
				        ]
				      ]
				    ]
				  ],
		        //'settings' => [
		           // 'number_of_shards' => 3,
		           // 'number_of_replicas' => 2
		        //],
		        'mappings' => [
		            'contenu' => [
		                '_source' => [
		                    'enabled' => true
		                ],
		                'properties' => [
		                    'titre' => [
		                        'type' => 'string',
		                        //'analyzer' => 'french'
		                    ],
		                    'lien_description' => [
		                        'type' => 'string',
		                        //'analyzer' => 'french'
		                    ]
		                ]
		            ]
		        ]
		    ]
		];
		// Create the index with mappings and settings now
		try {
			unset($params['body']['mappings']);
		
			//dump($params);
			//dd(self::$client->indices());
			$response = self::$client->indices()->create($params);
			//dd($response);
			return $response;
		} 
		catch (\Exception $e)
		{
			dd($e->getMessage());
		}
		//$response = self::$client->indices()->getMapping();
		//dump(['mappings', $response]);
		
	}

	function supprimerContenu($id)
	{
		$params = [
		    'index' => self::$index,
		    'type' => 'contenu',
		    'id' => $id
		];

		// Delete doc at /my_index/my_type/my_id
		$response = self::$client->delete($params);
		//dump($response);
		return $response;
	}

	function indexerContenu($contenu)
	{
		$vocabularies = Vocabulary::all()->pluck('shortname', 'id')->toArray();
		$contenu = clone $contenu;
		//dd($vocabularies);
		$contenu->proposePar;

		$contenu->description = strip_tags(html_entity_decode($contenu->description));
		foreach ($contenu->related as $related)
		{
			$slug = $vocabularies[$related->vocabulary_id];
			$t = $related->term->name;
			$contenu->$slug = (is_array($contenu->$slug)) ? array_merge($contenu->$slug, [ $t ]) : [ $t ];
		}
		unset($contenu->related);
		unset($contenu->data);
		if ($contenu->proposePar)
		{
			unset($contenu->proposePar->email);
		}
		//print_r($contenu);
		//return;
		$params = [
		    'index' => self::$index,
		    'type' => 'contenu',
		    'id' => $contenu->id,
		    'body' => $contenu
		];

		$response = self::$client->index($params);
		return $response;
	}

	function findContenu($id)
	{
		$params = [
		    'index' => self::$index,
		    'type' => 'contenu',
		    'id' => $id,
		];

		$response = self::$client->get($params);
		return $response;
	}

	function existsContenu($id)
	{
		$params = [
		    'index' => self::$index,
		    'type' => 'contenu',
		    'id' => $id,
		];

		$response = self::$client->exists($params);
		return $response;
	}

	function queryContenu($query, $filters = [], $order = null, $size = 20, $from = 0)
	{
		$niveaux = (Auth::user()) ? Auth::user()->terms()->pluck('name')->implode(' ') : '';	
		
		$params = [
		    'index' => self::$index,
		    'type' => 'contenu',
		    'body' => [
		        'query' => [
		        	'bool' => []		        						
		        ],
		        'size' => $size,
		        'from' => $from
		    ]
		];
		if ($query)
		{
			$params['body']['query']['bool']['must'] = [
        			'bool' => [
		        		'should' => [
			            	[ 'match' => [ 'titre' =>
			            		['query' => $query, 'boost' => 2 ]
			            	]],
			            	[ 'match' => [ 'description' =>
			            		['query' => $query, 'boost' => 0.5 ]
			            	]],
			            	[ 'match' => [ 'lien_description' =>
			            		['query' => $query, 'boost' => 0.5 ]
			            	]],
			            	[ 'match' => [ 'tags' => $query ]],
			            	[ 'match' => [ 'discipline' => $query ]],
			            	[ 'match' => [ 'thématique' => $query ]],
			            	[ 'match' => [ 'niveau' => 
			            		['query' => $query, 'boost' => 1 ] 
			            	]],
			            	[ 'match' => [ 'catégories' => $query ]],
			            ]
		         	]
		       ];
		}

		if (count($filters))
		{
			$clauses = [] ;
			//$must = [] ;
			foreach ($filters as $term => $val)
			{
				if ($term == 'duree_minutes')
				{
					$clauses[] = [ 'range' => [ $term => [
							'gte' => $val[0],
							'lte' => $val[1]
						] ] ];
				}
				else
				{
				
					$clauses[] = [ 'match' => [$term => join(' OR ', $val) ]] ;
				}
			}
			$params['body']['query']['bool']['filter']['bool']['must'] = $clauses;
			
		}

		// Scoring
		$score_avis = new \StdClass();
		$score_avis->field_value_factor = [
			  "field" => "score_avis",
			  "factor" => 0.2,
			  "modifier" => "ln2p",
			  "missing" => 2
		];
		$score_upvote = new \StdClass();
		$score_upvote->field_value_factor = [
			  "field" => "score_upvote",
			  "factor" => 0.2,
			  "modifier" => "ln2p",
			  "missing" => 0
		];
		$score_downvote = new \StdClass();
		$score_downvote->field_value_factor = [
			  "field" => "score_downvote",
			  "factor" => -0.2,
			  "modifier" => "ln2p",
			  "missing" => 0
		];

		$params['body']['query'] = [
			'function_score' => [
				'query' => $params['body']['query'],
				//"random_score" =>  new \StdClass, 
				"functions" => [					
					$score_avis,
					$score_upvote,
					$score_downvote,
				],
	            "boost" => "1",  
	            "boost_mode" => "multiply",                  
    		]
		];

		if ($niveaux)
		{
			$filter = new \StdClass();
			$filter->filter = [ "match" => ["niveau" => "CM2 CM1"] ];
			$filter->filter = [ "match" => ["niveau" => $niveaux] ];
			$filter->weight = 1.5;
			$params['body']['query']['function_score']['functions'][] = $filter;
		}

		//if (env('APP_ENV') == 'development') dump($params['body']['query']);
		//if (env('APP_ENV') == 'development') dump(json_encode($params['body']['query']));
		//print '<pre>' . print_r($params,1) . '</pre>';
		$response = self::$client->search($params);
		//if (env('APP_ENV') == 'development') dump($response);
		return $response;

	}


}
