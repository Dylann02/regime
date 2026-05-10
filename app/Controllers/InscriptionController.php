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

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $email = $this->request->getPost('email');
        $motDePasseRaw = $this->request->getPost('mot_de_passe');
        $genre = $this->request->getPost('genre');
        $dateNaissance = $this->request->getPost('date_naissance');

        $dataValidation = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $motDePasseRaw,
            'genre' => $genre,
            'date_naissance' => $dateNaissance,
        ];

        if (! $model->validate($dataValidation)) {
            return view('inscription', [
                'erreurs' => $model->errors()
            ]);
        }

        $data = [
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => password_hash($motDePasseRaw, PASSWORD_DEFAULT),
            'genre' => $genre,
            'date_naissance' => $dateNaissance,
        ];

        $model->insert($data);
        $userId = $model->insertID();

        session()->set('user_id', $userId);

        return redirect()->to('/inscription/etape2');
    }

    public function etape2()
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non spécifié');
        }

        return view('inscription_etape2', [
            'userId' => $userId
        ]);
    }

    public function finaliser()
    {
        $model = new UtilisateurModel();
        $userId = session()->get('user_id');
        if (! $userId) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non spécifié');
        }

        $data = [
            'taille_cm' => $this->request->getPost('taille_cm'),
            'poids_actuel' => $this->request->getPost('poids_actuel'),
        ];

        if (! $model->validate($data, 'validationRulesEtape2')) {
            return view('inscription_etape2', [
                'erreurs' => $model->errors(),
                'userId' => $userId
            ]);
        }

        $model->update($userId, $data);
        
        return redirect()->to('/inscription/choix_objectif');
    }

    public function choixObjectif()
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($userId);

        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        return view('choix_objectif', [
            'utilisateur' => $utilisateur,
            'imc' => $model->getIMC($userId),
            'poidsIdeal' => $model->getPoidsIdeal($userId)
        ]);
    }

    public function saveObjectif()
    {
        $userId = session()->get('user_id');
        if (! $userId) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        
        $objectif_actuel = $this->request->getPost('objectif_actuel');
        $valeur_objectif = $this->request->getPost('valeur_objectif');
        
        $model->update($userId, [
            'objectif_actuel' => $objectif_actuel,
            'valeur_objectif' => $valeur_objectif
        ]);
        
        $utilisateur = $model->find($userId);
        session()->set('user', [
            'id' => $utilisateur['id'],
            'nom' => $utilisateur['nom'],
            'prenom' => $utilisateur['prenom'],
            'email' => $utilisateur['email']
        ]);
        session()->remove('user_id');

        return redirect()->to('/profil');
    }

    public function profil()
    {
        $user = session()->get('user');
        if (! $user || ! isset($user['id'])) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($user['id']);
        $imc = $model->getIMC($user['id']);

        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        return view('profil', [
            'utilisateur' => $utilisateur,
            'imc' => $imc
        ]);
    }

    public function edit()
    {
        $user = session()->get('user');
        if (! $user || ! isset($user['id'])) {
            return redirect()->to('/login');
        }

        $model = new UtilisateurModel();
        $utilisateur = $model->find($user['id']);

        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        return view('modifier_profil', [
            'utilisateur' => $utilisateur
        ]);
    }

    public function update()
    {
        $user = session()->get('user');
        if (! $user || ! isset($user['id'])) {
            return redirect()->to('/login');
        }
        $model = new UtilisateurModel();
        $userId = $user['id'];

        $utilisateur = $model->find($userId);
        if (! $utilisateur) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur introuvable');
        }

        $data = [
            'nom' => $this->request->getPost('nom'),
            'prenom' => $this->request->getPost('prenom'),
            'email' => $this->request->getPost('email'),
            'genre' => $this->request->getPost('genre'),
            'date_naissance' => $this->request->getPost('date_naissance'),
            'taille_cm' => $this->request->getPost('taille_cm'),
            'poids_actuel' => $this->request->getPost('poids_actuel'),
        ];

        $model->update($userId, $data);
        
        $utilisateurMisAjour = $model->find($userId);
        if (! $utilisateurMisAjour) {
            return redirect()->to('/profil')->with('error', 'Erreur lors de la récupération des données');
        }
         
        session()->set('user', [
            'id' => $userId,
            'nom' => $utilisateurMisAjour['nom'],
            'prenom' => $utilisateurMisAjour['prenom'],
            'email' => $utilisateurMisAjour['email']
        ]);

        return redirect()->to('/profil')->with('message', 'Profil mis à jour avec succès');
    }
}