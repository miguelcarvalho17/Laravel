<?php

    namespace Database\Factories;

    use Illuminate\Database\Eloquent\Factories\Factory;
    use App\Models\User;
    use App\Models\Job;
    use Illuminate\Support\Facades\File;

    class JobOfferFactory extends Factory
    {
        
        /**
         * Define the model's default state.
         *
         * @return array
         */
        public function definition()
        {   
            $path = public_path().'/storage/pdf/CV-Exemplo.pdf';
            $file = File::get($path);	
            $user = User::where('type', 'user')->get()->random(1)->first();
            return [
                'idJob' => Job::all()->random()->id,
                'idUser' => $user->id,
                'nameUser' => $user->name,
                'content' => $this->faker->text(),
                'cv' => $file,
            ];
        }
    }