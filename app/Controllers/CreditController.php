<?php
namespace App\Controllers;

use App\Models\CreditModel;
use App\Models\UtilisateurModel;
class CreditController extends BaseController {
    public function index(){
        $user = session()->get('user');
        if (!$user || !isset($user['id'])) {
            return redirect()->to('/login');
        }
        $model = new  UtilisateurModel();
        $utilisateur = $model->find($user['id']);

        if (!$utilisateur) {
            return redirect()->to('/login');
        }

        return view('formCredit' , ['utilisateur' =>$utilisateur]);
    }

    public function ajoutCredit(){
        $credit =$this->request->getPost('credit');
        $creditModel = new CreditModel();
        $creditEncour=$creditModel->findByCode($credit);

        if(empty($creditEncour)){
            return redirect()->to('/ajoutArgent')->with('error' , 'le code n existe pas');
        }
        if($creditEncour['est_utilise'] == 1){
            return redirect()->to('/ajoutArgent')->with('error' , 'le code a ete utiliser');
        }

        $user = session()->get('user');
         if (!$user || !isset($user['id'])) {
            return redirect()->to('/login');
        }

        $utilisateurModel = new  UtilisateurModel();
        $utilisateur = $utilisateurModel->find($user['id']);

        if (!$utilisateur) {
            return redirect()->to('/login');
        }

        $utilisateurModel->update($user['id'] ,  [
            'solde' => $utilisateur['solde']+$creditEncour['montant']
        ]);

        $creditModel->update($creditEncour['id'],[
            'utilisateur_id' =>$user['id'],
            'date_utilisation' =>date('Y-m-d H:i:s'),
            'est_utilise' => 1
        ]);
        return redirect()->to('/profil')->with('success' , 'code ajouter avec success');

    }
}