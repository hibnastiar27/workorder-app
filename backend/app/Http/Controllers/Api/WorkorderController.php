<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Http\Requests\WorkorderRequest;
use App\Http\Resources\WorkorderResource;
use App\Models\Workorder;
use App\Services\WorkorderService;
use Illuminate\Http\Request;

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
        $validateData = $request->only(['status']);

        $updatedWorkorder = $this->workorderService->updateStatus($workorder, $validateData);

        return $this->sendResponse(
            new WorkorderResource($updatedWorkorder),
            'Workorder Status Updated Successfully'
        );
    }
}
