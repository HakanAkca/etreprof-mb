<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Log;


class UploadController extends Controller
{

    public function envoyer(Request $request)
    {

        $rules = ['file' => 'mimes:jpg,jpeg,png,gif,svg'];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return response('error', 403);
        }

        //$this->validate($request, ['file' => 'mimes:jpg']);

        if ($request->hasFile('file') && $request->file->isValid()) {

            $folder = 'storage/'. $request->input('folder');

            $file_name = str_random(10). '.' .$request->file->extension();

            $request->file->move($folder, $file_name);

            $path = '/' . $folder . '/' . $file_name;
            //print_r($file_path);
            //print_r($request->file('file'));

            //print_r($pj);
            //die('ok');
        }
        //die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
        return response()->json([
            'jsonrpc' => '2.0',
            'result' => $path,
            'id' => 'id']);
    }

    /*public function effacer(Request $request)
    {
        $success = false;
        $droit = 'Vous n\'avez pas le droit de supprimer ce fichier';
        $id = null;
        $pj = null;
        if ($request->input('id'))
        {
            $pj = PieceJointe::find($request->input('id'));
            if ($pj->effacablePar(Auth::user()))
            {
                $success = true;
                $pj->effacer();
            }
        }
        if (!$success)
        {
            Log::error('pj_effacer', [
                'pj' => $pj,
                'droit' => $droit,
                'referer' => url()->previous(),
                'post' => $request->all()
            ]);
        }
        else
        {
            Log::info('pj_effacer', [
                'pj' => $pj,
                'droit' => $droit,
                'referer' => url()->previous(),
                'post' => $request->all()
            ]);
        }
        return response()->json(['success' => $success, 'droit' => $droit, 'id' => $pj->id]);
    }

    function telecharger($id,$hash,$nom)
    {
        $fichier = PieceJointe::find($id);
        if ($hash != PieceJointe::hash($fichier->dossier_id))
        {
            die('Erreur : le lien n\'est pas correct');
        }
        //print $fichier->chemin;
        //die();
        $content_type = mime_content_type(storage_path('uploads/' . $fichier->chemin));
        $headers = array(
              'Content-Type: ' . $content_type ,
            );


        return response()->download(storage_path('uploads/' . $fichier->chemin), $fichier->nom, $headers);
    }*/
}