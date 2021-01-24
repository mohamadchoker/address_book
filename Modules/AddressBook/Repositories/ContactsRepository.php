<?php


namespace Modules\AddressBook\Repositories;



use Modules\AddressBook\Entities\Address;
use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Entities\ContactTag;
use Modules\AddressBook\Entities\PhoneNumber;

class ContactsRepository
{
    public static function getContacts($params)
    {
        $query = Contact::select(
            'contacts.id',
            'contacts.email',
            'contacts.photo',
            'contacts.job_title',
            'contacts.is_favorite',
            'contacts.location')
            ->selectRaw('GROUP_CONCAT(phone_numbers.number) as phones')
            ->selectRaw('CONCAT(contacts.first_name," ",contacts.last_name) as full_name')
            ->leftJoin('phone_numbers', 'phone_numbers.contact_id', '=', 'contacts.id')
            ->leftJoin('contact_tags', 'contact_tags.contact_id', '=', 'contacts.id')
            ->leftJoin('tags', 'tags.id', '=', 'contact_tags.tag_id')
            ->groupBy('contacts.id');

       // $query->where('phone_numbers.type','mobile');

        // used for datatable pagination
        $total_count = $query->get()->count();

        //filters
        if(isset($params['tags'])) {
            $services  = explode(',',$params['tags']);
            $query->whereIn('items.id',$services);
        }
        if(isset($params['group'])){
            $query->where('contacts.group_id',$params['group']);
        }

        //search input
        if (isset($params['search']) && $params['search']['value'] != '') {
            $search = $params['search']['value'];
            $query->whereLike(['first_name','last_name','email','contacts.job_title','contacts.location','tags.name'], $search);
        }

        //ordering
        if (isset($params['order']) && !is_null($params['order']) && $params['order'] != '') {
            $ordering_array = ['first_name','last_name', 'address','location'];
            $ordering_direction = $params['order']['0']['dir'];
            $order_by = $params['order']['0']['column'];
            $query->orderBy($ordering_array[$order_by], $ordering_direction);
        }

        // filtered data count
        $this_count = $query->get()->count();

        //pagination
        if (isset($params['length']) && $params['length'] != '-1') {
            $length = $params['length'];
            $start = $params['start'];
            $query->offset($start)->limit($length);

        }

        $contacts = $query->get();
        return ['contacts' => $contacts, 'total_count' => $total_count, 'this_count' => $this_count];

    }

    public static function createContact(array $data)
    {
        $contact = new Contact();
        $contact->user_id = $data['user_id'];
        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->photo = $data['avatar'];
        $contact->location = $data['location'];
        $contact->company = $data['company'];
        $contact->job_title = $data['job_title'];
        $contact->group_id = $data['group'];
        $contact->gender = $data['gender'];
        $contact->birth_date = $data['birth_date'];
        $contact->facebook_link = $data['facebook_link'];
        $contact->twitter_link = $data['twitter_link'];
        $contact->linkedin_link = $data['linkedin_link'];
        $contact->instagram_link = $data['instagram_link'];
        $contact->save();

        foreach ($data['phones'] as $phone)
        {
            $phone_number = new PhoneNumber();
            $phone_number->contact_id = $contact->id;
            $phone_number->number = $phone['number'];
            $phone_number->type = $phone['type'];
            $phone_number->save();
        }

        foreach ($data['addresses'] as $address)
        {
            $contact_address = new Address();
            $contact_address->contact_id = $contact->id;
            $contact_address->title = $address['title'];
            $contact_address->line1 = $address['title'];
            $contact_address->line2 = $address['line2'];
            $contact_address->state = $address['state'];
            $contact_address->city = $address['city'];
            $contact_address->street = $address['street'];
            $contact_address->zip = $address['zip'];
            $contact_address->country = $address['country'];
            $contact_address->save();

        }


        if( isset($data['tags'])) {
            $tags  = $data['tags'];
            foreach ($tags as $tag)
            {
                $client_tag = new ContactTag();
                $client_tag->contact_id = $contact->id;
                $client_tag->tag_id = $tag;
                $client_tag->save();
            }
        }
    }

    public static function updateContact($contact,array $data)
    {
        $contact->first_name = $data['first_name'];
        $contact->last_name = $data['last_name'];
        $contact->email = $data['email'];
        $contact->photo = $data['avatar'];
        $contact->location = $data['location'];
        $contact->company = $data['company'];
        $contact->job_title = $data['job_title'];
        $contact->group_id = $data['group'];
        $contact->gender = $data['gender'];
        $contact->birth_date = $data['birth_date'];
        $contact->facebook_link = $data['facebook_link'];
        $contact->twitter_link = $data['twitter_link'];
        $contact->linkedin_link = $data['linkedin_link'];
        $contact->instagram_link = $data['instagram_link'];
        $contact->save();

        PhoneNumber::where('contact_id',$contact->id)->delete();
        Address::where('contact_id',$contact->id)->delete();
        ContactTag::where('contact_id',$contact->id)->delete();

        foreach ($data['phones'] as $phone)
        {
            $phone_number = new PhoneNumber();
            $phone_number->contact_id = $contact->id;
            $phone_number->number = $phone['number'];
            $phone_number->type = $phone['type'];
            $phone_number->save();
        }

        foreach ($data['addresses'] as $address)
        {
            $contact_address = new Address();
            $contact_address->contact_id = $contact->id;
            $contact_address->title = $address['title'];
            $contact_address->line1 = $address['title'];
            $contact_address->line2 = $address['line2'];
            $contact_address->state = $address['state'];
            $contact_address->city = $address['city'];
            $contact_address->street = $address['street'];
            $contact_address->zip = $address['zip'];
            $contact_address->country = $address['country'];
            $contact_address->save();

        }

        if( isset($data['tags'])) {
            $tags  = $data['tags'];
            foreach ($tags as $tag)
            {
                $client_tag = new ContactTag();
                $client_tag->contact_id = $contact->id;
                $client_tag->tag_id = $tag;
                $client_tag->save();
            }
        }
    }

    public static function deleteContact($contact)
    {
        $contact->delete();
        PhoneNumber::where('contact_id',$contact->id)->delete();
        Address::where('contact_id',$contact->id)->delete();
        ContactTag::where('contact_id',$contact->id)->delete();
    }
}
