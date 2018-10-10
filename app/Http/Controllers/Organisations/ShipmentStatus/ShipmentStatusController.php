<?php

namespace App\Http\Controllers\Organisations\ShipmentStatus;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ShipmentStatus\ShipmentStatusInterface;
use App\Http\Resources\ShipmentStatus as ShipmentStatusResource;

class ShipmentStatusController extends Controller
{
    protected $shipmentStatus;

    public function __construct(ShipmentStatusInterface $shipmentStatus)
    {
        $this->shipmentStatus = $shipmentStatus;
    }

    public function index ()
    {
        $shipmentStatuss = $this->shipmentStatus->getNameShipmentStatus();

        return ShipmentStatusResource::collection($shipmentStatuss);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $this->shipmentStatus->create($request->all());

        return response()->json([
            'message' => config('shipmentStatus.created')
        ]);
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $shipmentStatus = $this->shipmentStatus->find($id);
        if (! $shipmentStatus) {
            return response()->json([
                'message' => config('shipmentStatus.notFound')
            ]);
        }

        $shipmentStatus->update([
            'name' => $request->name
        ]);

        return new ShipmentStatusResource($shipmentStatus);
    }

    public function destroy ($id)
    {
        $shipmentStatus = $this->shipmentStatus->find($id);
        if (! $shipmentStatus) {
            return response()->json([
                'message' => config('shipmentStatus.notFound')
            ]);
        }
        $shipmentStatus->delete();

        return response()->json([
            'message' => config('shipmentStatus.deleted')
        ]);
    }
}
