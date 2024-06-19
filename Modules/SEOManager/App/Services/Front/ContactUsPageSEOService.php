<?php

namespace Modules\SEOManager\App\Services\Front;

use Artesaos\SEOTools\Facades\SEOTools;
use Modules\Setting\App\Models\SiteDetail;

class ContactUsPageSEOService extends BaseSEOService
{
    public function setContactUsPageSEO(): void
    {
        $cacheKey = 'contactus_seo';
        $cacheTTL = now()->addHours(self::CACHE_TTL);

        $seoData = cache()->remember($cacheKey, $cacheTTL, function () {
            $siteDetails = SiteDetail::first();
            $title = __('contact_us');
            $description = __('Get in touch with us for any inquiries or support.');
            $canonicalUrl = route('contact-us.index');
            $logoUrl = $siteDetails->mainLogoLink();

            return compact('title', 'description', 'canonicalUrl', 'logoUrl');
        });

        $this->setBasicSEO($seoData['title'], $seoData['description'], $seoData['canonicalUrl']);

        if ($seoData['logoUrl']) {
            SEOTools::jsonLd()->addImage($seoData['logoUrl']);
        }
    }
}
