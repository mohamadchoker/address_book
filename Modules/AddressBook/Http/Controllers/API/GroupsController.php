<?php

namespace Modules\AddressBook\Http\Controllers\API;



use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\AddressBook\Entities\Group;
use Modules\AddressBook\Http\Requests\CreateGroupRequest;
use Modules\AddressBook\Http\Requests\UpdateGroupRequest;
use Modules\AddressBook\Repositories\GroupsRepository;
use Modules\AddressBook\Repositories\TagsRepository;
use Modules\AddressBook\Transformers\GroupsResource;
use Modules\AddressBook\Transformers\TagsResource;

class GroupsController extends Controller
{

    public function index(Request $request)
    {
        try {
            $data = GroupsRepository::getGroups($request->all());
            return (GroupsResource::collection($data['groups']))->additional([
                'recordsTotal' => $data['total_count'],
                'recordsFiltered' => $data['this_count'],
                'draw' => $request->draw,
            ]);
        }catch (\Exception $e){
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }


    public function store(CreateGroupRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = auth()->id();
            GroupsRepository::createGroup($data);
            DB::commit();


            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.created', ['attribute' => trans('strings.groups.name')])],200);

        }catch (\Exception $e){
            DB::rollBack();
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }


    public function update(UpdateGroupRequest $request, Group $group)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            GroupsRepository::updateGroup($group,$data);
            DB::commit();

            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.updated', ['attribute' => trans('strings.groups.name')])],200);

        }catch (\Exception $e){
            DB::rollBack();
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }

    public function destroy(Group $group)
    {
        try {
            if(GroupsRepository::checkGroupContacts($group->id)){
                return Response::json(['status'=>true,'title' =>  'Success' ,'message'=> trans('strings.groups.delete_exception')],403);
            }
            GroupsRepository::deleteGroup($group);
            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.deleted', ['attribute' => trans('strings.groups.name')])],200);
        }catch (\Exception $e){
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }
}
