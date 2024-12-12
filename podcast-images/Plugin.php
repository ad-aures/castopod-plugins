<?php

declare(strict_types=1);

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastImagesPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, SimpleRSSElement $channel): void
    {
        $srcSet = sprintf(
            '%s %s, %s %s, %s %s, %s %s, %s %s',
            $podcast->cover->feed_url,
            $podcast->cover->feed_width . 'w',
            $podcast->cover->large_url,
            $podcast->cover->large_width . 'w',
            $podcast->cover->medium_url,
            $podcast->cover->medium_width . 'w',
            $podcast->cover->thumbnail_url,
            $podcast->cover->thumbnail_width . 'w',
            $podcast->cover->tiny_url,
            $podcast->cover->tiny_width . 'w',
        );

        $images = $channel->addChild('images', null, 'https://podcastindex.org/namespace/1.0');
        $images->addAttribute('srcset', $srcSet);
    }

    public function rssAfterItem(Episode $episode, SimpleRSSElement $item): void
    {
        $srcSet = sprintf(
            '%s %s, %s %s, %s %s, %s %s, %s %s',
            $episode->cover->feed_url,
            $episode->cover->feed_width . 'w',
            $episode->cover->large_url,
            $episode->cover->large_width . 'w',
            $episode->cover->medium_url,
            $episode->cover->medium_width . 'w',
            $episode->cover->thumbnail_url,
            $episode->cover->thumbnail_width . 'w',
            $episode->cover->tiny_url,
            $episode->cover->tiny_width . 'w',
        );

        $images = $item->addChild('images', null, 'https://podcastindex.org/namespace/1.0');
        $images->addAttribute('srcset', $srcSet);
    }
}
