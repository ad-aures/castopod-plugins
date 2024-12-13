<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresFooPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        // YOUR CODE HERE
    }
}
