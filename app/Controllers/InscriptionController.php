<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;

class InscriptionController extends BaseController
{
    public function index()
    {
        return view('inscription');
    }

    public function store()
    {
        $model = new UtilisateurModel();

        $rules = [
            'nom' => 'required|min_length[2]',
            'prenom' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'mot_de_passe' => 'required|min_length[6]',
            'genre' => 'required|in_list[homme,femme,autre]',
            'date_naissance' => 'required|valid_date'
        ];

        if (! $this->validate($rules)) {
            return view('inscription', [
                'validation' => $this->validator
            ]);
        }

        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $this->request->getPost('email'),
            'mot_de_passe' => password_hash($this->request->getPost('mot_de_passe'), PASSWORD_DEFAULT),
            'genre' => $this->request->getPost('genre'),
            'date_naissance' => $this->request->getPost('date_naissance'),
        ];

        $model->insert($data);
        $userId = $model->insertID();

        return redirect()->to('/inscription/etape2?id=' . $userId);
    }

    public function etape2()
    {
        $userId = $this->request->getGet('id');

        return view('inscription_etape2', [
            'userId' => $userId
        ]);
    }

    public function finaliser()
    {
        $model = new UtilisateurModel();
        $userId = $this->request->getPost('user_id');

        $rules = [
            'taille_cm' => 'required|numeric',
            'poids_actuel' => 'required|numeric'
        ];

        if (! $this->validate($rules)) {
            return view('inscription_etape2', [
                'validation' => $this->validator,
                'userId' => $userId
            ]);
        }

        $model->update($userId, [
            'taille_cm' => $this->request->getPost('taille_cm'),
            'poids_actuel' => $this->request->getPost('poids_actuel'),
        ]);

        return redirect()->to('/profil?id=' . $userId);
    }

    public function profil()
    {
        $userId = $this->request->getGet('id');
        if (! $userId) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non spécifié');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($userId);

        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        return view('profil', [
            'utilisateur' => $utilisateur
        ]);
    }

    public function edit()
    {
        $userId = $this->request->getGet('id');
        if (! $userId) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non spécifié');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($userId);

        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        return view('modifier_profil', [
            'utilisateur' => $utilisateur
        ]);
    }

    public function update()
    {
        $model = new UtilisateurModel();
        $userId = $this->request->getPost('id');

        if (! $userId) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non spécifié');
        }

        $utilisateur = $model->find($userId);
        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        $rules = [
            'nom' => 'required|min_length[2]',
            'prenom' => 'required|min_length[2]',
            'email' => 'required|valid_email',
            'genre' => 'required|in_list[homme,femme,autre]',
            'date_naissance' => 'required|valid_date',
            'taille_cm' => 'required|numeric',
            'poids_actuel' => 'required|numeric'
        ];

        if (! $this->validate($rules)) {
            return view('modifier_profil', [
                'validation' => $this->validator,
                'utilisateur' => $utilisateur
            ]);
        }

        $model->update($userId, [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $this->request->getPost('email'),
            'genre' => $this->request->getPost('genre'),
            'date_naissance' => $this->request->getPost('date_naissance'),
            'taille_cm' => $this->request->getPost('taille_cm'),
            'poids_actuel' => $this->request->getPost('poids_actuel'),
        ]);

        return redirect()->to('/profil?id=' . $userId)->with('message', 'Profil mis à jour avec succès');
    }
}