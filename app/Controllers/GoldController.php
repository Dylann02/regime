<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class GoldController extends BaseController
{
    private const GOLD_PRICE = 15000;

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

        return view('gold/index', [
            'utilisateur' => $utilisateur,
            'goldPrice' => self::GOLD_PRICE
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

        return view('gold/activer', [
            'utilisateur' => $utilisateur,
            'goldPrice' => self::GOLD_PRICE
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

        $solde = (float) ($utilisateur['solde'] ?? 0);
        if ($solde < self::GOLD_PRICE) {
            session()->setFlashdata('error', 'Solde insuffisant pour activer l’option Gold.');
            return redirect()->to('/gold/activer');
        }

        $model->update($user['id'], [
            'est_gold' => 1,
            'solde' => $solde - self::GOLD_PRICE
        ]);

        session()->setFlashdata('success', 'Option Gold activée avec succès.');
        return redirect()->to('/gold');
    }
}
