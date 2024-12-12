<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use Modules\Plugins\Core\BasePlugin;

class AdAuresPodcastMediumPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, SimpleRSSElement $channel): void
    {
        // YOUR CODE HERE
    }
}
