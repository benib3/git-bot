<?php

namespace App\Faker;

use Faker\Factory;

class Faker
{

  private $faker;
  public function __construct()
  {
    $this->faker = Factory::create();
  }

  public function contentGenerator()
  {
    return $this->faker->paragraph(3) . "\n" .
      $this->faker->paragraph(2) . "\n" .
      $this->faker->paragraph(4);
  }
}
