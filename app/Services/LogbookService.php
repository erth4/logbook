<?php

namespace App\Services;

use App\Models\Logbook;

class LogbookService
{
    public function create($data)
    {
        $logbook = new Logbook;
        $logbook->id_user = auth()->user()->id ?? $data['id_user'];
        $logbook->id_status = intval($data['status']);
        $logbook->description = $data['description'];
        $logbook->execution_date = $data['execution_date'];
        $logbook->results = $data['results'];
        $logbook->constraint = $data['constraint'];
        $logbook->start_time = $data['start_time'];
        $logbook->end_time = $data['end_time'];
        $logbook->save();
        return $logbook;
    }

    public function update($data)
    {

        $logbook = Logbook::findOrfail($data['id']);
        $logbook->id_user = auth()->user()->id ?? $data['id_user'];
        $logbook->id_status = intval($data['status']);
        $logbook->description = $data['description'];
        $logbook->execution_date = $data['execution_date'];
        $logbook->results = $data['results'];
        $logbook->constraint = $data['constraint'];
        $logbook->start_time = $data['start_time'];
        $logbook->end_time = $data['end_time'];
        $logbook->save();
        return $logbook;
    }

    public function delete($id)
    {
        $logbook = Logbook::findOrfail($id);
        $logbook->delete();
        return $logbook;
    }
}