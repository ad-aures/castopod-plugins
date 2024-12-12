<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Libraries\SimpleRSSElement;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastEpisodeSeasonPlugin extends BasePlugin
{
    public function rssAfterItem(Episode $episode, SimpleRSSElement $item): void
    {
        if ($episode->number !== null) {
            $item->addChild('episode', (string) $episode->number, 'https://podcastindex.org/namespace/1.0');
        }

        if ($episode->season_number !== null) {
            $item->addChild('season', (string) $episode->season_number, 'https://podcastindex.org/namespace/1.0');
        }
    }
}
