<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Models\AdminModel;

class AuthController extends BaseController
{
    public function form()
    {
        return view('auth/login');
    }

    public function login()
    {
        // Validation basique
        $rules = [
            'email' => 'required|valid_email',
            'mot_de_passe' => 'required|min_length[8]'
        ];
        
        if (!$this->validate($rules)) {
            return view('auth/login', [
                'erreurs' => $this->validator->getErrors()
            ]);
        }
        
        $email = $this->request->getPost('email');
        $motDePasse = $this->request->getPost('mot_de_passe');
        
        // ===== VÉRIFIER D'ABORD SI C'EST UN ADMIN =====
        $adminModel = new AdminModel();
        $admin = $adminModel->where('email', $email)->first();
        
        if ($admin && password_verify($motDePasse, $admin['mot_de_passe'])) {
            // Authentification admin réussie
            session()->set('user', [
                'id' => $admin['id'],
                'nom' => $admin['nom'],
                'email' => $admin['email'],
                'type' => 'admin'
            ]);
            return redirect()->to('/dashboard');
        }
        
        // ===== SINON VÉRIFIER SI C'EST UN UTILISATEUR NORMAL =====
        $utilisateurModel = new UtilisateurModel();
        $user = $utilisateurModel->where('email', $email)->first();
        
        if ($user && password_verify($motDePasse, $user['mot_de_passe'])) {
            // Authentification utilisateur réussie
            session()->set('user', [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'type' => 'user'
            ]);
            return redirect()->to('/profil');
        }
        
        // ===== AUCUNE CORRESPONDANCE =====
        return view('auth/login', [
            'erreur' => 'Email ou mot de passe incorrect'
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}