<?php

namespace DVC\JobsSelectWidget\Widget\Frontend;

use Contao\FormSelectMenu;
use Contao\StringUtil;
use Plenta\ContaoJobsBasic\Contao\Model\PlentaJobsBasicOfferModel as OfferModel;

class JobsSelectWidget extends FormSelectMenu
{
    const NAME = 'jobs_select';

    protected $blnSubmitInput = true;
    protected $blnForAttribute = true;

    public function __construct($arrAttributes = null)
    {
        parent::__construct($arrAttributes);

        $this->arrOptions = \array_merge($this->getJobOptions(), $this->arrOptions);
    }

    private function getJobOptions(): array
    {
        $publishedOffers = OfferModel::findAllPublishedByTypesAndLocation([], []);

        if ($publishedOffers === null) {
            return [];
        }

        return \array_map(fn($offer) => [
            'type' => 'option',
            'label' => self::removeBasicEntities($offer->title),
            'value' => self::removeBasicEntities($offer->title),
        ], $publishedOffers->getModels());
    }

    private static function removeBasicEntities(string $source): string
	{
		$source = StringUtil::restoreBasicEntities($source);
		
		return str_replace(array('&amp;', '&lt;', '&gt;', '&nbsp;', '&shy;', '&ZeroWidthSpace;'), array('&', '<', '>', ' ', '', ''), $source);
	}
}
