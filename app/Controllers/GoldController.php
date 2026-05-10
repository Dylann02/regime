<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\ParametreModel;

class GoldController extends BaseController
{
    public function index()
    {
        $user = session()->get('user');
        if (!$user || !isset($user['id'])) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($user['id']);

        if (!$utilisateur) {
            return redirect()->to('/login');
        }

        $paramModel = new ParametreModel();
        $goldPrice = (float) ($paramModel->getValeur('prix_gold', '15000'));

        return view('gold/index', [
            'utilisateur' => $utilisateur,
            'goldPrice' => $goldPrice
        ]);
    }

    public function activerForm()
    {
        $user = session()->get('user');
        if (!$user || !isset($user['id'])) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($user['id']);

        if (!$utilisateur) {
            return redirect()->to('/login');
        }

        $paramModel = new ParametreModel();
        $goldPrice = (float) ($paramModel->getValeur('prix_gold', '15000'));

        return view('gold/activer', [
            'utilisateur' => $utilisateur,
            'goldPrice' => $goldPrice
        ]);
    }

    public function activer()
    {
        $user = session()->get('user');
        if (!$user || !isset($user['id'])) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($user['id']);

        if (!$utilisateur) {
            return redirect()->to('/login');
        }

        if (!empty($utilisateur['est_gold'])) {
            session()->setFlashdata('success', 'Vous êtes déjà membre Gold.');
            return redirect()->to('/gold');
        }

        $paramModel = new ParametreModel();
        $goldPrice = (float) ($paramModel->getValeur('prix_gold', '15000'));

        $solde = (float) ($utilisateur['solde'] ?? 0);
        if ($solde < $goldPrice) {
            session()->setFlashdata('error', 'Solde insuffisant pour activer l’option Gold.');
            return redirect()->to('/gold/activer');
        }

        $model->update($user['id'], [
            'est_gold' => 1,
            'solde' => $solde - $goldPrice
        ]);

        session()->setFlashdata('success', 'Option Gold activée avec succès.');
        return redirect()->to('/gold');
    }
}
