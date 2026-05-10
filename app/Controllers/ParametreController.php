<?php

namespace App\Controllers;

use App\Models\ParametreModel;

class ParametreController extends BaseController
{
    public function index()
    {
        $model = new ParametreModel();
        $params = $model->orderBy('cle_param')->findAll();

        return view('admin/parametres/index', [
            'params' => $params,
            'success' => session()->getFlashdata('success'),
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function create()
    {
        return view('admin/parametres/create', [
            'errors' => session()->getFlashdata('errors')
        ]);
    }

    public function store()
    {
        $model = new ParametreModel();
        $data = [
            'cle_param' => trim((string) $this->request->getPost('cle_param')),
            'valeur' => trim((string) $this->request->getPost('valeur')),
            'description' => trim((string) $this->request->getPost('description'))
        ];

        if ($model->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/admin/parametres')->with('success', 'Paramètre ajouté.');
    }

    public function edit($key)
    {
        $model = new ParametreModel();
        $param = $model->find($key);
        if (!$param) return redirect()->to('/admin/parametres')->with('errors', ['Paramètre introuvable.']);

        return view('admin/parametres/edit', ['param' => $param, 'errors' => session()->getFlashdata('errors')]);
    }

    public function update($key)
    {
        $model = new ParametreModel();
        if (!$model->find($key)) return redirect()->to('/admin/parametres')->with('errors', ['Paramètre introuvable.']);

        $data = [
            'valeur' => trim((string) $this->request->getPost('valeur')),
            'description' => trim((string) $this->request->getPost('description'))
        ];

        if ($model->update($key, array_merge(['cle_param' => $key], $data)) === false) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to('/admin/parametres')->with('success', 'Paramètre mis à jour.');
    }

    public function delete($key)
    {
        $model = new ParametreModel();
        if (!$model->find($key)) return redirect()->to('/admin/parametres')->with('errors', ['Paramètre introuvable.']);

        $model->delete($key);
        return redirect()->to('/admin/parametres')->with('success', 'Paramètre supprimé.');
    }
}
