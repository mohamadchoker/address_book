<?php


namespace Tests\Unit\Contacts;



use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\AddressBook\Entities\Contact;
use Modules\AddressBook\Repositories\ContactsRepository;
use Tests\TestCase;


class ContactsTest extends TestCase
{

    /** @test */

    public function it_can_create_contact()
    {


        $data =  factory(Contact::class)->make()->toArray();
        $contact = ContactsRepository::createContact($data);

        $this->assertInstanceOf(Contact::class, $contact);
        $this->assertEquals($data['first_name'], $contact->first_name);
        $this->assertEquals($data['last_name'], $contact->last_name);
        $this->assertEquals($data['photo'], $contact->photo);
        $this->assertEquals($data['email'], $contact->email);
        $this->assertEquals($data['location'], $contact->location);
        $this->assertEquals($data['company'], $contact->company);
        $this->assertEquals($data['job_title'], $contact->job_title);
        $this->assertEquals($data['group_id'], $contact->group_id);
        $this->assertEquals($data['birth_date'], $contact->birth_date);
        $this->assertEquals($data['gender'], $contact->gender);
        $this->assertEquals($data['facebook_link'], $contact->facebook_link);
        $this->assertEquals($data['twitter_link'], $contact->twitter_link);
        $this->assertEquals($data['linkedin_link'], $contact->linkedin_link);
        $this->assertEquals($data['instagram_link'], $contact->instagram_link);

    }
}
