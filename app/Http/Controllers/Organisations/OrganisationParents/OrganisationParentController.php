<?php

namespace App\Http\Controllers\Organisations\OrganisationParents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\OrganisationParents\OrganisationParentInterface;
use App\Http\Resources\OrganisationParent as OrganisationParentResource;

class OrganisationParentController extends Controller
{
    protected $organisation;
    public function __construct (OrganisationParentInterface $organisation)
    {
        $this->organisation = $organisation;
    }

    public function index ()
    {
        $organisation = $this->organisation->getAll();

        return OrganisationParentResource::collection($organisation);
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $this->organisation->create($request->all());

        return response()->json([
            'message' => __('organisation.created')
        ]);
    }

    public function update (Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $organisation = $this->organisation->find($id);
        if (! $organisation) {
            return response()->json([
                'message' => __('organisation.notFound')
            ]);
        }

        $organisation->update([
            'name' => $request->name
        ]);

        return new OrganisationParentResource($organisation);
    }

    public function destroy ($id)
    {
        $organisation = $this->organisation->find($id);
        if (! $organisation) {
            return response()->json([
                'message' => __('organisation.notFound')
            ]);
        }
        $organisation->delete();

        return response()->json([
            'message' => __('organisation.deleted')
        ]);
    }
}
