<?php

namespace Modules\AddressBook\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Http\Requests\CreateContactRequest;
use Modules\AddressBook\Repositories\ContactsRepository;
use Modules\AddressBook\Transformers\ContactsResource;

/**
 * Class ContactsController
 * @package Modules\AddressBook\Http\Controllers\API
 */
class ContactsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $data = ContactsRepository::getContacts($request->all());
        return (ContactsResource::collection($data['contacts']))->additional([
            'recordsTotal' => $data['total_count'],
            'recordsFiltered' => $data['this_count'],
            'draw' => $request->draw,
        ]);
    }


    /**
     * @param  CreateContactRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateContactRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['user_id'] = auth()->id();
            $data['birth_date'] =  Carbon::createFromDate($data['birth_date'])->toDateString();
            ContactsRepository::createContact($data);
            DB::commit();

            session()->flash('success', trans('strings.crud.created', ['attribute' => trans('strings.contacts.name')]));
            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.created', ['attribute' => trans('strings.contacts.name')]),'redirect_to' => route('contacts.index')],200);

        }catch (\Exception $e){
            DB::rollBack();
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }


    /**
     * @param  Request  $request
     * @param  Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Contact $contact)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['birth_date'] =  Carbon::createFromDate($data['birth_date'])->toDateString();
            ContactsRepository::updateContact($contact,$data);
            DB::commit();

            session()->flash('success', trans('strings.crud.updated', ['attribute' => trans('strings.contacts.name')]));
            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.updated', ['attribute' => trans('strings.contacts.name')]),'redirect_to' => route('contacts.index')],200);

        }catch (\Exception $e){
            DB::rollBack();
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }

    /**
     * @param  Contact  $contact
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Contact $contact)
    {
        try {
            ContactsRepository::deleteContact($contact);
            return Response::json(['status'=>true,'title' =>  'Success' ,'message'=>trans('strings.crud.deleted', ['attribute' => trans('strings.contacts.name')])],200);
        }catch (\Exception $e){
            return Response::json(['status' => false,'message'=>trans('strings.errors.general'),'exception'=>$e->getMessage()],500);
        }
    }
}
