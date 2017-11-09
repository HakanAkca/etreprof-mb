<?php

namespace App\Services;

use Cache;
use SSH;
use Hash;
use DB;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Diagnostic
{
    private static $_salt = 'HaMc?°13';

    public static function hash($id)
    {
        return md5($id . self::$_salt);
    }

    public static function checkHash($id, $hash)
    {
        return (self::hash($id) == $hash) ? 1 : 0;
    }

    public static function resultatsUser($sid, $colonne, $valeur, $id = null)
    {
        $reponses = DB::table(env('LIMESURVEY_DB') . '.lime_survey_' . $sid)
            ->where($colonne, $valeur)
            ->orderby('id', 'desc');

        if ($id)
        {
            $reponses->where('id', $id);            
        }
        return $reponses->first();

    }

    public static function questions($sid, $reponses)
    {
        $questions = DB::table(env('LIMESURVEY_DB') . '.lime_questions')
            ->where('sid', $sid)
            ->get()
            ->reduce(function ($arr, $q) use ($reponses) {
                $cle = $q->sid . 'X' . $q->gid . 'X' . $q->qid;
                if (!empty($reponses->$cle)) {
                    $arr['"{' . $q->title . '}"'] = "'" . $reponses->$cle . "'";
                }
                return $arr;
            }, []);

        return $questions;

        
    }

    public static function htmlMessage($sid, $questions)
    {
        $htmlMessage = DB::table(env('LIMESURVEY_DB') . '.lime_assessments')
            ->where('sid', $sid)
            ->orderBy('id', 'asc')
            ->take(1)
            ->get()
            ->map(function ($html) use ($questions) {
                $html->message = str_replace(array_keys($questions), array_values($questions), $html->message);
                $html->message = str_replace(array_map(function ($k) {
                    return htmlentities($k);
                },
                    array_keys($questions)), array_values($questions), $html->message);
                return $html;
            });
        return $htmlMessage;
    }

    public static function publicUrl($id)
    {
        return action('DiagnosticController@htmlPourPdf', [$id, rawurlencode(self::hash($id))]);
       
    }

    public static function shellCommand($url)
    {
        return "node " . base_path('nodeToPdf/Convert.js' . ' ' . $url);
        
    }

    public static function createPdf($id)
    {
        //$url = 'http://www.commentreparer.com';
        //$url = 'http://test.etreprof.fr/test/youtube.html';

        $url = self::publicUrl($id);
        $command = self::shellCommand($url);
        $data = exec($command, $output);
        $return = ['command' => $command, 'output' => $output, 'data' => $data];
        //$command = 'ls';
        //dd($output, $r);
        $json = implode(',', $output);
        //echo implode('//////////////////', $output);
        //print $json;

        try {
            $decoded = json_decode($json, true);
            if (!is_array($decoded))
            {
                $decoded = ['error' => 'unable to decode', 'return' => $json, 'url' => $url];
            }
            $return = $return + $decoded;

            return $return['file'];
        }
        catch (\Exception $exception)
        {
            print $json;
            print $exception->getMessage();
            return $return;
        }
    }
}

