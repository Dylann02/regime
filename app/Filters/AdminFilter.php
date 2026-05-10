<?php 

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class AdminFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $user = session()->get('user');
        
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }
        
        // Vérifier si l'utilisateur est un admin (clé 'type' peut être absente)
        if (!isset($user['type']) || $user['type'] !== 'admin') {
            return redirect()->to('/profil')->with('error', 'Accès réservé aux administrateurs.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire après la requête
    }
}
