<?php

namespace Modules\Profile\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Modules\Profile\App\Http\Requests\ProfileRequest;
use Modules\User\App\Models\User;

class ProfileController extends Controller
{
    private Model $user;

    public function __construct() {
        $this->user = User::query()->find(auth()->id());
    }

    public function edit(): View
    {
        return view('profile::edit-profile', ['user' => $this->user]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $this->user->update($request->validated());
        return to_route('profile.edit')->with('success', __('entity_edited', ['entity' => __('profile')]));
    }
}
