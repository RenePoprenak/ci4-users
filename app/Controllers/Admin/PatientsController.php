<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PatientModel;

class PatientsController extends BaseController
{
    public function index()
    {
        return view('admin/patients/index', [
            'title' => 'Pacienti',
        ]);
    }

    public function table()
    {
        $model = model(PatientModel::class);

        $perPage = 15;
        $patients = $model->paginatedList($perPage);

        return view('admin/patients/_table', [
            'patients' => $patients,
            'pager'    => $model->pager,
        ]);
    }

    public function create()
    {
        return view('admin/patients/_form', [
            'mode' => 'create',
            'patient' => [
                'first_name' => '',
                'last_name' => '',
                'birth_number' => '',
                'birth_date' => '',
                'email' => '',
                'phone' => '',
                'address_line1' => '',
                'address_line2' => '',
                'city' => '',
                'zip' => '',
                'note' => '',
            ],
            'errors' => [],
            'action' => route_to('admin.patients.store'),
        ]);
    }

    public function store()
    {
        $model = model(\App\Models\PatientModel::class);

        $data = $this->request->getPost([
            'first_name','last_name','birth_number','birth_date','email','phone',
            'address_line1','address_line2','city','zip','note',
        ]);

        // remove non-digits from birth_number
        $data['birth_number'] = preg_replace('/\D+/', '', (string)($data['birth_number'] ?? ''));

        if (! $this->validate('patient')) {
            return view('admin/patients/_form', [
                'mode' => 'create',
                'patient' => $data,
                'errors' => $this->validator->getErrors(),
                'action' => route_to('admin.patients.store'),
            ]);
        }

        $model->insert($data);

        return $this->response
            ->setHeader('HX-Trigger', json_encode([
                'patientsChanged' => true,
                'closePatientModal' => true,
            ]))
            ->setBody(view('ui/_toast_oob', [
                'message' => lang('admin/patients.created'),
                'type'    => 'success',
            ]));
    }

    public function edit(int $id)
    {
        $model = model(\App\Models\PatientModel::class);
        $patient = $model->find($id);

        if (! $patient) {
            return $this->response->setStatusCode(404);
        }

        return view('admin/patients/_form', [
            'mode' => 'edit',
            'patient' => $patient,
            'errors' => [],
            'action' => route_to('admin.patients.update', $id),
        ]);
    }

    public function update(int $id)
    {
        $model = model(\App\Models\PatientModel::class);
        $patient = $model->find($id);

        if (! $patient) {
            return $this->response->setStatusCode(404);
        }

        $data = $this->request->getPost([
            'first_name','last_name','birth_number','birth_date','email','phone',
            'address_line1','address_line2','city','zip','note',
        ]);

        $data['birth_number'] = preg_replace('/\D+/', '', (string)($data['birth_number'] ?? ''));

        if (! $this->validate('patient')) {
            return view('admin/patients/_form', [
                'mode' => 'edit',
                'patient' => array_merge((array) $patient, $data),
                'errors' => $this->validator->getErrors(),
                'action' => route_to('admin.patients.update', $id),
            ]);
        }

        $model->update($id, $data);

        return $this->response
            ->setHeader('HX-Trigger', json_encode([
                'patientsChanged' => true,
                'closePatientModal' => true,
            ]))
            ->setBody(view('ui/_toast_oob', [
                'message' => lang('admin/patients.updated'),
                'type'    => 'success',
            ]));
    }
}