<?php

namespace Modules\SocialNetwork\App\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Modules\SocialNetwork\App\Models\SocialNetwork as SocialNetworkModel;

trait SocialNetwork
{
    public function getUserSocialNetworks(Authenticatable $user): Collection
    {
        $socialNetworks = collect();
        $userSocialNetworks = $user->socialNetworks;
        foreach ($userSocialNetworks as $socialNetwork) {
            $socialNetworks[$socialNetwork->name] = $socialNetwork->url;
        }

        return $socialNetworks;
    }

    public function getSocialNetworksWithTag($tag): Collection
    {
        $socialNetworks = collect();
        $socialNetworkWithTag = SocialNetworkModel::query()->where('tag', $tag)->get();
        foreach ($socialNetworkWithTag as $socialNetwork) {
            $socialNetworks[$socialNetwork->name] = $socialNetwork->url;
        }

        return $socialNetworks;
    }

    public function rules(): array
    {
        $rules = [];
        foreach (self::SOCIAL_NETWORKS as $key => $urlPattern) {
            $rules[$key] = 'nullable|url';
        }

        return $rules;
    }
}
