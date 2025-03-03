<?php

namespace App\Services;

use App\Models\Workorder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WorkorderService
{

    public function getAll()
    {
        return Workorder::all();
    }

    public function create(array $data)
    {
        $workorder = Workorder::create($data);

        $workorder->update([
            'code_workorder' => 'WO-' . now()->format('Ymd') . '-' . $workorder->id
        ]);

        // return Workorder::create($data);
        return $workorder;
    }

    public function update(Workorder $workorder, array $data)
    {
        $workorder->update($data);
        return $workorder;
    }

    public function delete(Workorder $workorder)
    {
        return $workorder->delete();
    }

    public function getAssignWorkorders()
    {
        $workorders = Workorder::where('user_id', Auth::id())->get();

        if ($workorders->isEmpty()) {
            return null;
        }

        return $workorders;
    }

    public function updateStatus(Workorder $workorder, array $data)
    {
        if ($workorder->user_id !== Auth::id()) {
            throw ValidationException::withMessages(['message' => 'Unauthorized']);
        }

        if (!in_array($data['status'], ['Pending', 'In Progress', 'Completed'])) {
            throw ValidationException::withMessages(['message' => 'Invalid Status']);
        }

        $workorder->update(['status' => $data['status']]);
        return $workorder;
    }
}
