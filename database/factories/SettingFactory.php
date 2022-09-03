<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'address' => '',
            'phone'   => '',
            'email'   => '',
            'fb_url'  => '',
            'instagram_url' => '',
            'twitter_url'    => '',
            'linkedin_url'   => '',
            'header_heading' => '',
            'header_description'=> '',
            'get_in_touch_description'=> '',
            'contact_us_description'=> '',
            'policy'=> '',
        ];
    }
}
