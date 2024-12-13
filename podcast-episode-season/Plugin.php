<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastEpisodeSeasonPlugin extends BasePlugin
{
    public function rssAfterItem(Episode $episode, RssFeed $item): void
    {
        if ($episode->number !== null) {
            $item->addChild('episode', (string) $episode->number, RssFeed::PODCAST_NAMESPACE);
        }

        if ($episode->season_number !== null) {
            $item->addChild('season', (string) $episode->season_number, RssFeed::PODCAST_NAMESPACE);
        }
    }
}
