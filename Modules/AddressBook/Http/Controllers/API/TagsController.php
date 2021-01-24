<?php

namespace Modules\AddressBook\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\AddressBook\Entities\Tag;
use Modules\AddressBook\Http\Requests\CreateTagRequest;
use Modules\AddressBook\Http\Requests\UpdateTagRequest;
use Modules\AddressBook\Repositories\TagsRepository;
use Modules\AddressBook\Transformers\TagsResource;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = TagsRepository::getTags($request->all());
            return (TagsResource::collection($data['tags']))->additional([
                'recordsTotal' => $data['total_count'],
                'recordsFiltered' => $data['this_count'],
                'draw' => $request->draw,
            ]);
        }catch (\Exception $e){
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }


    public function store(CreateTagRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = auth()->id();
            TagsRepository::createTag($data);
            DB::commit();


            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.created', ['attribute' => trans('strings.tags.name')])],200);

        }catch (\Exception $e){
            DB::rollBack();
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }


    public function update(UpdateTagRequest $request, Tag $tag)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            TagsRepository::updateTag($tag,$data);
            DB::commit();

            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.updated', ['attribute' => trans('strings.tags.name')])],200);

        }catch (\Exception $e){
            DB::rollBack();
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }

    public function destroy(Tag $tag)
    {
        try {
            if(TagsRepository::checkTagsContacts($tag->id)){
                return Response::json(['status'=>true,'title' =>  'Success' ,'message'=> trans('strings.tags.delete_exception')],403);
            }

            TagsRepository::deleteTag($tag);
            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.deleted', ['attribute' => trans('strings.tags.name')])],200);
        }catch (\Exception $e){
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }
}
