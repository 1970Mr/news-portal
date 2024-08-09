<?php

namespace Modules\Setting\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\FileManager\App\Helpers\ImageHelper;
use Modules\Setting\App\Models\SiteDetail;

class SiteDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = SiteDetail::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => __('setting::site_details.title'),
            'description' => __('setting::site_details.description'),
            'keywords' => __('setting::site_details.keywords'),
            'footer_text' => __('setting::site_details.footer_text'),
            'main_logo_id' => ImageHelper::createDefaultImage(configPath: 'common.default_logo.file_path')->id,
            'second_logo_id' => ImageHelper::createDefaultImage(configPath: 'common.default_logo.file_path')->id,
            'favicon_id' => ImageHelper::createDefaultImage(configPath: 'common.default_favicon.file_path')->id,
        ];
    }
}
