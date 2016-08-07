<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;
use App\Shop;
use App\Position;

class ShopsTableSeeder extends Seeder
{
    private $locations = [];
    private $index = 0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate Faker
        $faker = Factory::create(config('app.locale'));

        // Init Location
        $this->initLocation();

        // Create Shop
        for ($i = 0; $i < 20; $i++) {
            $shop = Shop::create([
                'name'        => $faker->company,
                'description' => random_int(0, 1) == 1 ? $faker->catchPhrase : null,
                'url'         => random_int(0, 1) == 1 ? $faker->url : null,
                'tel'         => random_int(0, 1) == 1 ? $faker->phoneNumber : null,
                'open_at'     => Carbon::createFromFormat('H:i', $faker->time('H:i')),
                'close_at'    => Carbon::createFromFormat('H:i', $faker->time('H:i')),
            ]);

            // Decide how many position (0~3) belongs to this shop
            $positionAmount = random_int(0, 3);

            // Create positions (0~3)
            for ($j = 0; $j < $positionAmount; $j++) {
                $location = $this->getLocation();
                Position::create([
                    'shop_id'     => $shop->id,
                    'description' => mb_substr($faker->realText(10, 2), 0, 2) . '店',
                    'address'     => $location['address'],
                    'longitude'   => $location['lng'],
                    'latitude'    => $location['lat'],
                ]);
            }
        }
    }

    private function initLocation()
    {
        // Read location file generate by other faker
        $file = file_get_contents(realpath(__DIR__ . '/../../locationFaker.json'));

        // Convert json to php array
        $this->locations = json_decode($file, true);

        // Mass it
        for ($i = 0; $i < count($this->locations); $i++) {
            $rand = random_int(0, count($this->locations) - 1);
            $temp = $this->locations[$i];
            $this->locations[$i] = $this->locations[$rand];
            $this->locations[$rand] = $temp;
        }

        // Reset index
        $this->index = 0;
    }

    private function getLocation()
    {
        // Add index
        $this->index++;

        // Return location (must -1 cause for logic)
        return $this->locations[$this->index - 1];
    }
}
