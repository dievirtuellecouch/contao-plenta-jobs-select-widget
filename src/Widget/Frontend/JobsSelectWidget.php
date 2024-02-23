<?php

namespace DVC\JobsSelectWidget\Widget\Frontend;

use Contao\FormSelectMenu;
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

        return \array_map(fn($offer) => [
            'type' => 'option',
            'label' => html_entity_decode($offer->title),
            'value' => html_entity_decode($offer->title),
        ], $publishedOffers->getModels());
    }
}
