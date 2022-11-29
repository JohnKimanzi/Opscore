<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;


class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $marital_status=$this->faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed'])[0];
      //  $gender=$this-> faker->randomElement(['female', 'male'])[0];

        return [
            'first_name'=>$this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone1'=> $this->faker->numerify('07########'),
            'phone2'=>$this->faker->numerify('07########'),
            'work_email'=> $this->faker->unique()->safeEmail(),
            'personal_email'=>$this->faker->unique()->safeEmail(),
            'national_id'=> $this->faker->randomNumber(8),
            'passport_number'=> $this->faker->randomNumber(8),
            'huduma_number'=> $this->faker->randomNumber(8),
            'permanent_address' => $this->faker->word(),
            'residence' =>$this->faker->word(),
            'sap'=> $this->faker->randomNumber(4),
           // 'department_id' => $this->faker->randomElement(['Finance', 'Operations', 'IT', 'Human resource', 'marketing', 'Coporate']),
            //'designation_id' => $this->faker->randomElement(['Agent', 'Developer', 'OPM', 'IT specialist', 'HRM', 'Assistant HRM', 'Director', "Auditor"]),
            'basic_salary'=> $this->faker->numberBetween(20000, 100000),
            'dob'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
          //  'gender'=> $gender,
            // 'marital_status' => $marital_status,
          //  'dateHired'=> $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
