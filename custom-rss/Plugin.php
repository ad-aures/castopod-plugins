<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;
use Modules\Plugins\Core\RSS;

class AdAuresCustomRssPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        /** @var ?RSS $customRSS */
        $customRSS = $this->getPodcastSetting($podcast->id, 'custom-rss');
        
        if ($customRSS === null) {
            return;
        }

        $customSimpleRSS = $customRSS->toSimpleRSS();
        if (! $customSimpleRSS) {
            return;
        }

        $channel->appendNodes($customSimpleRSS);
    }

    public function rssAfterItem(Episode $episode, RssFeed $item): void
    {
        /** @var ?RSS $customRSS */
        $customRSS = $this->getEpisodeSetting($episode->id, 'custom-rss');
        
        if ($customRSS === null) {
            return;
        }

        $customSimpleRSS = $customRSS->toSimpleRSS();
        if (! $customSimpleRSS) {
            return;
        }

        $item->appendNodes($customSimpleRSS);
    }
}
