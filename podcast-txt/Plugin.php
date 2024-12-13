<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastTxtPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $txts = $this->getPodcastSetting($podcast->id, 'txt') ?? [];

        foreach ($txts as $txt) {
            $record = $channel->addChild('txt', $txt['value'], RssFeed::PODCAST_NAMESPACE);

            if (array_key_exists('purpose', $txt)) {
                $record->addAttribute('purpose', $txt['purpose']);
            }
        }
    }

    public function rssAfterItem(Episode $episode, RssFeed $item): void
    {
        $txts = $this->getEpisodeSetting($episode->id, 'txt') ?? [];

        foreach ($txts as $txt) {
            $record = $item->addChild('txt', $txt['value'], RssFeed::PODCAST_NAMESPACE);

            if (array_key_exists('purpose', $txt)) {
                $record->addAttribute('purpose', $txt['purpose']);
            }
        }
    }
}
