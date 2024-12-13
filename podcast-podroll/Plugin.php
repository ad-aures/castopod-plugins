<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastPodrollPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $feedGUIDs = $this->getPodcastSetting($podcast->id, 'feed-guids');

        if ($feedGUIDs === null) {
            return;
        }

        $podroll = $channel->addChild('podroll', null, RssFeed::PODCAST_NAMESPACE);

        foreach ($feedGUIDs as $feedGUID) {
            $remoteItem = $podroll->addChild('remoteItem', null, RssFeed::PODCAST_NAMESPACE);
            $remoteItem->addAttribute('feedGuid', $feedGUID);
        }
    }
}
