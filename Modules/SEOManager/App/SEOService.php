<?php

namespace Modules\SEOManager\App;

use Modules\SEOManager\App\Http\Requests\SEOSettingRequest;

class SEOService
{
    public function updateOrCreate(SEOSettingRequest $request): void
    {
        $modelType = $request->input('model_type');
        $modelId = $request->input('model_id');
        $model = $modelType::findOrFail($modelId);

        $model->seoSettings()->updateOrCreate([], $request->validated());
    }
}
