<?php

namespace App\Http\Controllers\ConfirmTypes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ConfirmType\ConfirmTypeInterface;
use App\Http\Resources\ConfirmType as ConfirmTypeResource;

class ConfirmTypeController extends Controller
{
    protected $confirmType;
    public function __construct(ConfirmTypeInterface $confirmType)
    {
        $this->confirmType = $confirmType;
    }

    public function index ()
    {
        $confirmTypes = $this->confirmType->getNameConfirmType();

        return confirmTypeResource::collection($confirmTypes);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $this->confirmType->create($request->all());

        return response()->json([
            'message' => __('confirmType.created')
        ]);
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $confirmType = $this->confirmType->find($id);
        if (! $confirmType) {
            return response()->json([
                'message' => __('confirmType.notFound')
            ]);
        }

        $confirmType->update([
            'name' => $request->name
        ]);

        return new confirmTypeResource($confirmType);
    }

    public function destroy ($id)
    {
        $confirmType = $this->confirmType->find($id);
        if (! $confirmType) {
            return response()->json([
                'message' => __('confirmType.notFound')
            ]);
        }
        $confirmType->delete();

        return response()->json([
            'message' => __('confirmType.deleted')
        ]);
    }
}
