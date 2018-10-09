<?php

namespace App\Http\Controllers\Organisations\ShipmentTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ShipmentTypes\ShipmentTypeInterface;
use App\Http\Resources\ShipmentType as ShipmentTypeResource;

class ShipmentTypeController extends Controller
{
    protected $shipmentType;

    public function __construct(ShipmentTypeInterface $shipmentType)
    {
        $this->shipmentType = $shipmentType;
    }

    public function index ()
    {
        $shipmentTypes = $this->shipmentType->getNameShipmentType();

        return ShipmentTypeResource::collection($shipmentTypes);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $this->shipmentType->create($request->all());

        return response()->json([
            'message' => config('shipmentType.created')
        ]);
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $shipmentType = $this->shipmentType->find($id);
        if (! $shipmentType) {
            return response()->json([
                'message' => config('shipmentType.notFound')
            ]);
        }

        $shipmentType->update([
            'name' => $request->name
        ]);

        return new ShipmentTypeResource($shipmentType);
    }

    public function destroy ($id)
    {
        $shipmentType = $this->shipmentType->find($id);
        if (! $shipmentType) {
            return response()->json([
                'message' => config('shipmentType.notFound')
            ]);
        }
        $shipmentType->delete();

        return response()->json([
            'message' => config('shipmentType.deleted')
        ]);
    }
}
