<?php

namespace Modules\Setting\App\Services;

use Modules\Setting\App\Http\Requests\AboutUsRequest;
use Modules\Setting\App\Models\AboutUs;

class AboutUsService
{
    public function update(AboutUsRequest $request): void
    {
        $validData = $request->validated();
        $about = AboutUs::query()->firstOrNew();
        $about->fill($validData)->save();
    }
}
