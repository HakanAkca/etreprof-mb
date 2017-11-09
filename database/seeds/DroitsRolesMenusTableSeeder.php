<?php

use Illuminate\Database\Seeder;

class DroitsRolesMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('droits')->truncate();
    	DB::table('droits_roles')->truncate();
    	DB::table('menus')->truncate();

		$droits = [
			['id' => 1, 'groupe' => 'Back-Office', 'code' => 'acces_admin', 'description' => 'Accéder au back-office'],
			['id' => 2, 'groupe' => 'Contenus', 'code' => 'menu_contenus', 'description' => 'Afficher le menu contenus'],
			['id' => 3, 'groupe' => 'Contenus', 'code' => 'proposer_contenu', 'description' => 'Proposer un contenu'],
			['id' => 4, 'groupe' => 'Contenus', 'code' => 'relire_contenu', 'description' => 'Relire un contenu (donner avis)'],
			['id' => 5, 'groupe' => 'Contenus', 'code' => 'publier_contenu', 'description' => 'Publier un contenu'],
			['id' => 6, 'groupe' => 'Modules thématiques', 'code' => 'gerer_modules', 'description' => 'Gérer les modules thématiques'],
			['id' => 7, 'groupe' => 'Catégories', 'code' => 'modifier_vocabulaire', 'description' => 'Créer ou supprimer les catégories'],
			['id' => 8, 'groupe' => 'Catégories', 'code' => 'ajouter_termes', 'description' => 'Ajouter un terme de catégorie'],
			['id' => 9, 'groupe' => 'Utilisateurs', 'code' => 'roles_utilisateurs', 'description' => 'Accorder les rôles aux utilisateurs (DANGEREUX !)'],
			['id' => 10, 'groupe' => 'Utilisateurs', 'code' => 'roles_droits', 'description' => 'Modifier les droits affectés aux rôles (DANGEREUX !)'],
			['id' => 11, 'groupe' => 'Structure', 'code' => 'modifier_menus', 'description' => 'Modifier les menus'],
			['id' => 12, 'groupe' => 'Utilisateurs', 'code' => 'liste_utilisateurs', 'description' => 'Voir la liste d\'utilisateurs'],
			['id' => 13, 'groupe' => 'Utilisateurs', 'code' => 'qualifier_utilisateurs', 'description' => 'Qualifier les utilisateurs'],
			['id' => 14, 'groupe' => 'Utilisateurs', 'code' => 'voir_contenus_supprimes', 'description' => 'Voir les contenus supprimés (corbeille)'],
			['id' => 15, 'groupe' => 'Contenus', 'code' => 'supprimer_son_contenu', 'description' => 'Supprimer son propre contenu proposé'],
			['id' => 16, 'groupe' => 'Contenus', 'code' => 'supprimer_tous_contenus', 'description' => 'Supprimer tous les contenus'],
			['id' => 17, 'groupe' => 'Structure', 'code' => 'modifier_structure', 'description' => 'Menu Structure du site'],



		];

    	//foreach ($droits as $droit)
    	//{
    	DB::table('droits')->insert($droits);
		//}

		$droits_roles = [
			2 => [ ], //Membre inactif
			3 => [ ], // Membre actif
			4 => [ 1,2,3,4 ], //Tête chercheuse
			//5 => [ 1,2,3,4,5 ], // Validant
			5 => '*', // Superadmin
		];


    	foreach ($droits_roles as $role_id => $droits_role)
    	{
    		if ($droits_role == '*')
    		{
				foreach ($droits as $droit)
				{
					DB::table('droits_roles')->insert(['droit_id' => $droit['id'], 'role_id' => $role_id]);
				}
			}
			else
			{
    			foreach ($droits_role as $droit_id)
				{
    				DB::table('droits_roles')->insert(['droit_id' => $droit_id, 'role_id' => $role_id]);
				}
			}
		}


    	$menus = [
    		[
				'id' => 1,
				'text' => 'Menu admin',
				'url' => '',
				'droit_id' => 1,
				'parent_id' => null,
			],
			[
				'id' => 2,
				'text' => 'CONTENUS',
				'url' => '#',
				'droit_id' => 2,
				'parent_id' => 1,
			],
			[
				'id' => 3,
				'text' => 'Liste',
				'url' => '/admin/contenus',
				'droit_id' => 2,
				'parent_id' => 2,
			],
			[
				'id' => 102,
				'text' => 'UTILISATEURS',
				'url' => '#',
				'droit_id' => 2,
				'parent_id' => 1,
			],
			[
				'id' => 104,
				'text' => 'Liste',
				'url' => '/admin/utilisateurs',
				'droit_id' => 12,
				'parent_id' => 102,
				'ordre' => 0,
			],
			[
				'id' => 103,
				'text' => 'Droits',
				'url' => '/admin/utilisateurs/droits',
				'droit_id' => 10,
				'parent_id' => 102,
				'ordre' => 2,
			],
			[
				'id' => 201,
				'text' => 'STRUCTURE DU SITE',
				'url' => '#',
				'droit_id' => 17,
				'parent_id' => 1,
			],
			[
				'id' => 203,
				'text' => 'Catégories',
				'url' => '/admin/categories',
				'droit_id' => 7,
				'parent_id' => 201,
			],
			[
				'id' => 204,
				'text' => 'Menus',
				'url' => '/admin/menus',
				'droit_id' => 11,
				'parent_id' => 201,
			],
			[
				'id' => 300,
				'text' => 'Boutons gauche',
				'url' => '#',
				'droit_id' => null,
				'parent_id' => null,
			],
			[
				'id' => 301,
				'text' => 'Proposer un contenu',
				'url' => '/admin/contenus/lien',
				'droit_id' => 3,
				'parent_id' => 300,
			],

    	];

    	foreach ($menus as $menu)
    	{
    		DB::table('menus')->insert($menu);
		}

    }
}
