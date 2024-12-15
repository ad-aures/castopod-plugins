<?php

declare(strict_types=1);

use App\Entities\Episode;
use Modules\Plugins\Core\BasePlugin;

class AdAuresOp3Plugin extends BasePlugin
{
    public function rssBeforeItem(Episode $episode): void
    {
        // only prefix public episodes
        if ($episode->is_premium) {
            return;
        }

        // is OP3 disabled on this podcast?
        $isDisabled = $this->getPodcastSetting($episode->podcast_id, 'disable');

        if ($isDisabled) {
            return;
        }

        // remove scheme from audioURI if https
        $audioURLWithoutHTTPS = preg_replace('(^https://)', '', $episode->audio_url);

        $episode->audio_url = 'https://op3.dev/e,pg=' . $episode->podcast->guid . '/' . $audioURLWithoutHTTPS;
    }
}
