<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Requests\WorkorderRequest;
use App\Http\Resources\WorkorderResource;
use App\Models\ProductionNote;
use App\Models\Workorder;
use App\Services\WorkorderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkorderController extends ApiController
{
    protected $workorderService;

    public function __construct(WorkorderService $workorderService)
    {
        $this->workorderService = $workorderService;
    }

    /**
     * Menampilkan seluruh data
     */
    public function index()
    {
        return $this->sendResponse(
            WorkorderResource::collection(Workorder::all()),
            'List Workorders'
        );
    }

    /**
     * Menambahkan data
     */
    public function store(WorkorderRequest $request)
    {
        $workorder = $this->workorderService->create($request->validated());
        return $this->sendResponse(
            new WorkorderResource($workorder),
            "Workorder Created Successfully",
            201
        );
    }

    /**
     * Menampilkan 1 data
     */
    public function show(string $id)
    {
        $workorder = Workorder::findOrFail($id);
        return $this->sendResponse(
            new WorkorderResource($workorder),
            'Workorder Details'
        );
    }

    /**
     * Update data by id
     */
    public function update(WorkorderRequest $request, Workorder $workorder)
    {
        $workorder = $this->workorderService->update($workorder, $request->validated());
        return $this->sendResponse(
            new WorkorderResource($workorder),
            'Workorder Updated Successfully'
        );
    }

    /**
     * Hapus data
     */
    public function destroy(Workorder $workorder)
    {
        $this->workorderService->delete($workorder);
        return $this->sendResponse(
            null,
            'Workorder Deleted Successfully'
        );
    }


    /**
     * Menampilkan workorder sesuai id operator
     */
    public function assignWorkorders()
    {
        $workorders = $this->workorderService->getAssignWorkorders();

        if ($workorders === null || $workorders->isEmpty()) {
            return $this->sendError(
                'No assigned workorders found',
                [],
                404
            );
        }

        return $this->sendResponse(
            WorkorderResource::collection($workorders),
            'Assign Workorders'
        );
    }

    /**
     * Update status untuk role operator
     */
    public function updateStatus(WorkorderRequest $request, Workorder $workorder)
    {
        $validateData = $request->only(['status', 'quantity_completed']);

        try {
            $updatedWorkorder = $this->workorderService->updateStatus($workorder, $validateData);
            return $this->sendResponse(
                new WorkorderResource($updatedWorkorder),
                'Workorder Status Updated Successfully'
            );
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 422);
        }
    }

    /**
     * Menambahkan Catatan produksi
     */
    public function addProductionNote(Request $request, Workorder $workorder)
    {
        $request->validate([
            'note' => 'required|string|max:255'
        ]);

        if ($workorder->status != 'In Progress') {
            return $this->sendError(
                'Workoder is not In Progress',
                [],
                400
            );
        }

        $note = ProductionNote::create([
            'workorder_id' => $workorder->id,
            'note' => $request->note,
            'created_by' => Auth::id(),
        ]);

        return $this->sendResponse(
            $note,
            'Production note added successfully',
            201
        );
    }


    /**
     * Menampilkan Semua catatan by operator
     */
    public function getProductionNotes(Workorder $workorder)
    {
        $notes = ProductionNote::where('workorder_id', $workorder->id)->get();

        return $this->sendResponse(
            $notes,
            'All production notes show successfully'
        );
    }
}
