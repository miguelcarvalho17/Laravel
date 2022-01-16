<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\User;
    use Illuminate\Support\Facades\File;

    class JobFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {
            $Company = User::where('type', 'company')->get()->random(1)->first();
            $path = public_path().'/storage/img/guest-user.jpeg';
            $file = File::get($path);
            
            return [
                'company_id' => $Company->id,
                'title' => $this->faker->jobTitle(),
                'typeJob' => $this->faker->randomElement(['Full-time', 'Part-time', 'Volunteer','Internship']),
                'company' => $Company->name,
                'location' => $Company->location,
                'contact' => $Company->email,
                'logo' => $file,
                'content' => $this->faker->text(),
                'salary' => $this->faker->numberBetween(735, 3000),
                'is_active' => 1,
            ];
        }
    }