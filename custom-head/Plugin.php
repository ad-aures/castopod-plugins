<?php

declare(strict_types=1);

use App\Libraries\HtmlHead;
use Modules\Plugins\Core\BasePlugin;

class AdAuresCustomHeadPlugin extends BasePlugin
{
    public function siteHead(HtmlHead $head): void
    {
        /** @var ?string $customHead */
        $customHead = $this->getGeneralSetting('custom-head');

        if ($customHead === null) {
            return;
        }

        $head->appendRawContent($customHead);
    }
}
