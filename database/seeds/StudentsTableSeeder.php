<?php

use App\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        for ($i=0; $i < 1000; $i++) { 
        	
        	$gender = $faker->randomElement(['male', 'female']);

    		$student = new Student;
    		$student->id_number = $faker->unique()->randomNumber;
    		$student->first_name = $faker->firstName($gender);
    		$student->last_name = $faker->lastName;
    		$student->gender = $gender;
    		$student->course_id = rand(1,3);
	        $student->save();
    	}
    }
}
