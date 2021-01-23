<?php
namespace Modules\AddressBook\Database\factories;


use App\User;
use Illuminate\Database\Eloquent\Factory;
use Modules\AddressBook\Entities\Contact;

class ContactsFactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $genders = ['Male','Female'];

        return [
            'user_id' => \factory(User::class),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' =>  $this->faker->unique()->email,
            'birth_date' => $this->faker->date(),
            'gender' => $genders[$this->faker->numberBetween(0,count($genders)-1)],
            'location' => $this->faker->city,
            'company' => $this->faker->company,

        ];
    }
}

