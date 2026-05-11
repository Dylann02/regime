<?php

namespace App\Controllers;

use App\Models\RegimeModel;

class RegimeController extends BaseController
{
    public function index()
    {
        $regimeModel = new RegimeModel();
        $regimes = $regimeModel->orderBy('id', 'DESC')->findAll();

        return view('admin/regimes/index', [
            'regimes' => $regimes,
            'success' => session()->getFlashdata('success'),
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function create()
    {
        return view('admin/regimes/create', [
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function store()
    {
        $regimeModel = new RegimeModel();
        $data = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'description' => trim((string) $this->request->getPost('description')),
            'pct_viande' => (float) $this->request->getPost('pct_viande'),
            'pct_poisson' => (float) $this->request->getPost('pct_poisson'),
            'pct_volaille' => (float) $this->request->getPost('pct_volaille'),
            'variation_kg_semaine' => (float) $this->request->getPost('variation_kg_semaine'),
            'est_actif' => $this->request->getPost('est_actif') ? 1 : 0,
        ];

        if ($regimeModel->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $regimeModel->errors());
        }

        return redirect()->to('/admin/regimes')->with('success', 'Régime ajouté avec succès.');
    }

    public function edit($id)
    {
        $regimeModel = new RegimeModel();
        $regime = $regimeModel->find($id);

        if (!$regime) {
            return redirect()->to('/admin/regimes')->with('errors', ['Régime introuvable.']);
        }

        return view('admin/regimes/edit', [
            'regime' => $regime,
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function update($id)
    {
        $regimeModel = new RegimeModel();
        if (!$regimeModel->find($id)) {
            return redirect()->to('/admin/regimes')->with('errors', ['Régime introuvable.']);
        }

        $data = [
            'nom' => trim((string) $this->request->getPost('nom')),
            'description' => trim((string) $this->request->getPost('description')),
            'pct_viande' => (float) $this->request->getPost('pct_viande'),
            'pct_poisson' => (float) $this->request->getPost('pct_poisson'),
            'pct_volaille' => (float) $this->request->getPost('pct_volaille'),
            'variation_kg_semaine' => (float) $this->request->getPost('variation_kg_semaine'),
            'est_actif' => $this->request->getPost('est_actif') ? 1 : 0,
        ];

        if ($regimeModel->update($id, $data) === false) {
            return redirect()->back()->withInput()->with('errors', $regimeModel->errors());
        }

        return redirect()->to('/admin/regimes')->with('success', 'Régime mis à jour.');
    }

    public function delete($id)
    {
        $regimeModel = new RegimeModel();
        if (!$regimeModel->find($id)) {
            return redirect()->to('/admin/regimes')->with('errors', ['Régime introuvable.']);
        }

        $regimeModel->delete($id);

        return redirect()->to('/admin/regimes')->with('success', 'Régime supprimé.');
    }
}
