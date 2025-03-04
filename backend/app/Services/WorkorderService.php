<?php

namespace App\Services;

use App\Models\Workorder;
use Carbon\Carbon;
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
        // $workorder->update(['status' => $data['status']]);

        $currentStatus = $workorder->status;
        $newStatus = $data['status'];

        // Logika transisi status:
        // 1. Transisi dari Pending ke In Progress
        if ($currentStatus === 'Pending' && $newStatus === 'In Progress') {
            $workorder->update([
                'status' => 'In Progress',
                'in_progress_started_at' => now(),
            ]);
        }
        // 2. Transisi dari In Progress ke Completed
        elseif ($currentStatus === 'In Progress' && $newStatus === 'Completed') {
            // Pastikan field quantity_completed ada
            if (!isset($data['quantity_completed'])) {
                throw ValidationException::withMessages([
                    'message' => 'Quantity completed is required when completing a work order.'
                ]);
            }
            $completedQty = $data['quantity_completed'];

            // Pastikan quantity yang diselesaikan tidak melebihi quantity yang tersedia
            if ($completedQty > $workorder->quantity) {
                throw ValidationException::withMessages([
                    'message' => 'Completed quantity exceeds available quantity.'
                ]);
            }

            // Hitung waktu yang dihabiskan di status In Progress
            $startTime = $workorder->in_progress_started_at ? Carbon::parse($workorder->in_progress_started_at) : now();
            $timeSpent = $startTime->diffInSeconds(now());

            // Update work order:
            // - Kurangi quantity berdasarkan quantity_completed
            // - Set status menjadi Completed
            // - Catat waktu yang dihabiskan di status In Progress
            $workorder->update([
                'status' => 'Completed',
                'quantity' => $workorder->quantity - $completedQty,
                'time_spent_in_progress' => $timeSpent,
            ]);
        }
        // Jika transisi tidak valid
        else {
            throw ValidationException::withMessages([
                'message' => 'Invalid status transition.'
            ]);
        }
        return $workorder;
    }
}
