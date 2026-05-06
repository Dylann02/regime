<?php 

namespace App\FIlters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface {

    public function before(RequestInterface $request, $arguments = null)
    {
        $userRole = session()->get('role');

        if (!$userRole || !in_array($userRole, $arguments)) {
            return redirect()->to('/')->with('error', 'Vous n\'avez pas les permissions nécessaires pour accéder à cette page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire après la requête
    }
}