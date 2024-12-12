<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastPodrollPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, SimpleRSSElement $channel): void
    {
        $feedGUIDs = $this->getPodcastSetting($podcast->id, 'feed-guids');

        if ($feedGUIDs === null) {
            return;
        }

        $podroll = $channel->addChild('podroll', null, 'https://podcastindex.org/namespace/1.0');

        foreach ($feedGUIDs as $feedGUID) {
            $remoteItem = $podroll->addChild('remoteItem', null, 'https://podcastindex.org/namespace/1.0');
            $remoteItem->addAttribute('feedGuid', $feedGUID);
        }
    }
}
