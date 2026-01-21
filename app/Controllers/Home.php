<?php

namespace App\Controllers;

use App\Models\PatientModel;

class Home extends BaseController
{
    public function index()
    {
        return view('home/patients', [
            'title' => lang('admin/patients.patients'),
        ]);
    }

    public function patients()
    {
        return $this->index();
    }

    public function patientsTable()
    {
        $model = model(PatientModel::class);

        $patients = $model->orderBy('last_name', 'ASC')
            ->orderBy('first_name', 'ASC')
            ->paginate(15);

        return view('home/_patients_table', [
            'patients' => $patients,
            'pager'    => $model->pager,
        ]);
    }

    public function patientDetail(int $id)
    {
        $model = model(PatientModel::class);
        $patient = $model->find($id);

        if (! $patient) {
            return $this->response->setStatusCode(404)->setBody('');
        }

        return view('home/_patient_detail', [
            'patient' => $patient,
        ]);
    }
}
