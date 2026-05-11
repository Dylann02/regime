<?php

namespace App\Controllers;

use App\Models\ActiviteModel;

class ActiviteController extends BaseController
{
    public function index()
    {
        $activiteModel = new ActiviteModel();
        $activites = $activiteModel->orderBy('id', 'DESC')->findAll();

        return view('admin/activites/index', [
            'activites' => $activites,
            'success' => session()->getFlashdata('success'),
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function create()
    {
        return view('admin/activites/create', [
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function store()
    {
        $activiteModel = new ActiviteModel();
        $data = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'description' => trim((string) $this->request->getPost('description')),
            'intensite' => $this->request->getPost('intensite'),
            'est_actif' => $this->request->getPost('est_actif') ? 1 : 0,
        ];

        if ($activiteModel->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $activiteModel->errors());
        }

        return redirect()->to('/admin/activites')->with('success', 'Activité ajoutée avec succès.');
    }

    public function edit($id)
    {
        $activiteModel = new ActiviteModel();
        $activite = $activiteModel->find($id);

        if (!$activite) {
            return redirect()->to('/admin/activites')->with('errors', ['Activité introuvable.']);
        }

        return view('admin/activites/edit', [
            'activite' => $activite,
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function update($id)
    {
        $activiteModel = new ActiviteModel();
        if (!$activiteModel->find($id)) {
            return redirect()->to('/admin/activites')->with('errors', ['Activité introuvable.']);
        }

        $data = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'description' => trim((string) $this->request->getPost('description')),
            'intensite' => $this->request->getPost('intensite'),
            'est_actif' => $this->request->getPost('est_actif') ? 1 : 0,
        ];

        if ($activiteModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $activiteModel->errors());
        }

        return redirect()->to('/admin/activites')->with('success', 'Activité mise à jour.');
    }

    public function delete($id)
    {
        $activiteModel = new ActiviteModel();
        if (!$activiteModel->find($id)) {
            return redirect()->to('/admin/activites')->with('errors', ['Activité introuvable.']);
        }

        $activiteModel->delete($id);

        return redirect()->to('/admin/activites')->with('success', 'Activité supprimée.');
    }
}
