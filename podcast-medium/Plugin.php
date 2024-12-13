<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastMediumPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $medium = $this->getPodcastSetting($podcast->id, 'medium');

        $channel->addChild('medium', $medium, RssFeed::PODCAST_NAMESPACE);
    }
}
