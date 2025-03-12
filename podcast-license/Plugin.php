<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastLicensePlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $license = $this->getPodcastSetting($podcast->id, 'license');

        $licenseValue = match ($license) {
            'CC-BY-4.0'       => 'CC-BY-4.0',
            'CC-BY-NC-4.0'    => 'CC-BY-NC-4.0',
            'CC-BY-NC-ND-4.0' => 'CC-BY-NC-ND-4.0',
            'POD-V4V-1.0'     => 'POD-V4V-1.0',
            default           => 'All rights reserved',
        };

        $channel->addChild('license', $licenseValue, RssFeed::PODCAST_NAMESPACE);
    }
}
