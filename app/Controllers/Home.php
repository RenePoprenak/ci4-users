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
        /** @var PatientModel $model */
        $model = model(PatientModel::class);

        $search = trim((string) $this->request->getGet('search'));
        if ($search !== '') {
            $searchDigits = preg_replace('/\D+/', '', $search);

            $model->groupStart()
                ->like('last_name', $search)
                ->orLike('first_name', $search);

            if ($searchDigits !== '') {
                $model->orLike('birth_number', $searchDigits);
            }

            $model->groupEnd();
        }

        $patients = $model
            ->orderBy('last_name', 'ASC')
            ->orderBy('first_name', 'ASC')
            ->paginate(15);

        return response()
            ->setHeader(
                'HX-Push-Url',
                site_url('/') . ($search !== '' ? ('?search=' . rawurlencode($search)) : '')
            )
            ->setBody(view('home/_patients_table', [
                'patients' => $patients,
                'pager'    => $model->pager,
                'search'   => $search,
            ]));
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
