<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastTxtPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, SimpleRSSElement $channel): void
    {
        $txts = $this->getPodcastSetting($podcast->id, 'txt') ?? [];

        foreach ($txts as $txt) {
            $record = $channel->addChild('txt', $txt['value'], 'https://podcastindex.org/namespace/1.0');

            if (array_key_exists('purpose', $txt)) {
                $record->addAttribute('purpose', $txt['purpose']);
            }
        }
    }

    public function rssAfterItem(Episode $episode, SimpleRSSElement $item): void
    {
        $txts = $this->getEpisodeSetting($episode->id, 'txt') ?? [];

        foreach ($txts as $txt) {
            $record = $item->addChild('txt', $txt['value'], 'https://podcastindex.org/namespace/1.0');

            if (array_key_exists('purpose', $txt)) {
                $record->addAttribute('purpose', $txt['purpose']);
            }
        }
    }
}
