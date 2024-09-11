<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Facades\QrCodeServiceFacade as QrCode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefixes = ['77', '78', '70', '76', '75'];
        $telephone = $this->faker->numerify($this->faker->randomElement($prefixes) . '#######');
        $qrCodePath = QrCode::generateQrCode($telephone);
        return [
            'surname' => $this->faker->name,
            'adresse' => $this->faker->address,
            'telephone' => $telephone,
            'qrcode' => $qrCodePath,
            'role_id' => 3,
        ];
    }
}
