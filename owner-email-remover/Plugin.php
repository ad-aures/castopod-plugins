<?php

declare(strict_types=1);

use App\Entities\Podcast;
use App\Libraries\RssFeed;
use Modules\Plugins\Core\BasePlugin;

class AdAuresOwnerEmailRemoverPlugin extends BasePlugin
{
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        $unhideOwnerEmail = $this->getPodcastSetting($podcast->id, 'unhide-owner-email');

        if ($unhideOwnerEmail) {
            return;
        }

        // remove itunes:owner / itunes:email
        $ownerEmailNode = $channel->xpath('//itunes:owner/itunes:email');
        if (is_array($ownerEmailNode)) {
            $ownerEmailParentNode = $ownerEmailNode[0];
            unset($ownerEmailParentNode[0]);
        }

        // remove owner email from podcast:locked tag
        $podcastLockedOwner = $channel->xpath('//podcast:locked/@owner') ?? [];
        foreach ($podcastLockedOwner as $node) {
            unset($node[0]);
        }
    }
}
