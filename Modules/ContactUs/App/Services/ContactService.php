<?php

namespace Modules\ContactUs\App\Services;

use Modules\ContactUs\App\Http\Requests\ContactInfoRequest;
use Modules\ContactUs\App\Models\ContactInfo;

class ContactService
{
    public function update(ContactInfoRequest $request): void
    {
        $validData = $request->validated();
        $contactInfo = ContactInfo::query()->firstOrNew();
        $contactInfo->fill($validData)->save();
    }
}
