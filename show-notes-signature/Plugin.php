<?php

declare(strict_types=1);

use App\Entities\Episode;
use Modules\Plugins\Core\BasePlugin;
use Modules\Plugins\Core\Markdown;

class AdAuresShowNotesSignaturePlugin extends BasePlugin
{
    public function rssBeforeItem(Episode $episode): void
    {
        /** @var ?Markdown $showNotesSignature */
        $showNotesSignature = $this->getPodcastSetting($episode->podcast_id, 'show-notes-signature');

        if ($showNotesSignature === null) {
            return;
        }

        $episode->description_html .= '<footer>' . $showNotesSignature->renderHTML() . '</footer>';
    }
}
