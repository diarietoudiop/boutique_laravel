<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Facades\RoleServiceFacade as RoleService;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'prenom' => $this->faker->firstName,
            'nom' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'role_id' => RoleService::getRoleIdByName('boutiquier'), // Default role
            'estBloquer' => $this->faker->boolean,
            'photo' => "/storage/images/avatar.jpg",
        ];
    }

    public function admin()
    {
        return $this->state(fn(array $attributes) => ['role_id' => RoleService::getRoleIdByName('admin')]);
    }

    public function client()
    {
        return $this->state(fn(array $attributes) => ['role_id' => RoleService::getRoleIdByName('client')]);
    }

    public function boutiquier()
    {
        return $this->state(fn(array $attributes) => ['role_id' => RoleService::getRoleIdByName('boutiquier')]);
    }
}
