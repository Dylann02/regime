<?php
namespace App\Controllers;
use App\Models\UtilisateurModel;

class AuthController extends BaseController
{
    public function form()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new UtilisateurModel();
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
        $user = $model->where('email', $email)->first();
        
        if (!$user || !password_verify($motDePasse, $user['mot_de_passe'])) {
            return view('auth/login', [
                'erreur' => 'Email ou mot de passe incorrect'
            ]);
        }
        
        // Stocker uniquement les données non sensibles en session
        session()->set('user', [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'email' => $user['email']
        ]);
        
        return redirect()->to('/profil');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}