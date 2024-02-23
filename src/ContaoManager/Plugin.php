<?php

namespace DVC\JobsSelectWidget\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use DVC\JobsSelectWidget\JobsSelectWidgetBundle;
use Plenta\ContaoJobsBasic\PlentaContaoJobsBasicBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(JobsSelectWidgetBundle::class)
                ->setLoadAfter([
                    ContaoCoreBundle::class,
                    PlentaContaoJobsBasicBundle::class,
                ])
        ];
    }
}
