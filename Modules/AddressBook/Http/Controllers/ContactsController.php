<?php

namespace Modules\AddressBook\Http\Controllers;

use App\Country;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Entities\Group;
use Modules\AddressBook\Entities\Tag;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $groups = Group::all()->pluck('name','id');
        $tags = Tag::all()->pluck('name','id');
        $countries = Country::all()->pluck('name','id');
        $jobs = Contact::all()->whereNotNull('job_title')->pluck('job_title','job_title')->unique();
        $companies = Contact::all()->whereNotNull('company')->pluck('company','company')->unique();
        $locations = Contact::all()->whereNotNull('location')->pluck('location','location')->unique();
        return view('addressbook::contacts.index',compact('groups','tags','jobs','companies','locations','countries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $groups = Group::all()->pluck('name','id');
        $tags = Tag::all()->pluck('name','id');
        $countries = Country::all()->pluck('name','id');
        return view('addressbook::contacts.create',compact('groups','tags','countries'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('addressbook::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $contact = Contact::with(['phones','addresses','tags'])->withCount(['phones','addresses'])->find($id);
        $groups = Group::all()->pluck('name','id');
        $tags = Tag::all()->pluck('name','id');
        $countries = Country::all()->pluck('name','id');
        $contact->birth_date = Carbon::parse($contact->birth_date)->format('m/d/Y');
        return view('addressbook::contacts.edit',compact('contact','groups','tags','countries'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
