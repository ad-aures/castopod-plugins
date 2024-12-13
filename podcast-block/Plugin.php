<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastBlockPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $blockAll = $this->getPodcastSetting($podcast->id, 'block-all');

        if ($blockAll) {
            $channel->addChild('block', 'yes', RssFeed::PODCAST_NAMESPACE);
            return;
        }

        $allowedPlatforms = $this->getPodcastSetting($podcast->id, 'allowed-platforms') ?? [];
        if ($allowedPlatforms !== []) {
            $channel->addChild('block', 'yes', RssFeed::PODCAST_NAMESPACE);
            foreach ($allowedPlatforms as $platform) {
                $block = $channel->addChild('block', 'no', RssFeed::PODCAST_NAMESPACE);
                $block->addAttribute('id', $platform);
            }
            return;
        }

        $blockedPlatforms = $this->getPodcastSetting($podcast->id, 'blocked-platforms') ?? [];
        foreach ($blockedPlatforms as $platform) {
            $block = $channel->addChild('block', 'yes', 'https://podcastindex.org/namespace/1.0');
            $block->addAttribute('id', $platform);
        }
    }
}
