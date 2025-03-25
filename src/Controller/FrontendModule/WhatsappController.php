<?php

declare(strict_types=1);

namespace Respinar\ContaoWhatsappBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: "miscellaneous")]
class WhatsappController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        // Check if the current page has WhatsApp fields set
        $page = $this->getPageModel();

        // Get the root page
        $rootPage = PageModel::findById($page->rootId);
        if ($rootPage === null) {
            // Log an error or handle gracefully; for now, assume CTA is disabled
            return new Response();
        }
       
         if ($page->whatsappDisabled ?? $rootPage->whatsappDisabled ?? false) {
            return new Response();
        }       

        // Assign data to the template
        $template->set('whatsappTitle', $page->whatsappTitle ?: $rootPage->whatsappTitle ?: $model->whatsappTitle);
        $template->set('whatsappNumber', $page->whatsappNumber ?: $rootPage->whatsappNumber ?: $model->whatsappNumber);
        $template->set('whatsappMessage', $page->whatsappMessage ?: $rootPage->whatsappMessage ?: $model->whatsappMessage);
        $template->set('searchable', False);

        // Add JavaScript file to the page
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/respinarcontaowhatsapp/js/whatsapp.js|static';

        return $template->getResponse();
    }

    private function isWhatsappVisible(PageModel $page, ModuleModel $model): bool
    {

        while ($page !== null) {
            $visibility = $page->whatsappVisibility;

            if ($visibility !== 'default') {                
                return $visibility === 'show';
            }

            $page = PageModel::findById($page->pid);
        }

        return $model->whatsappIsVisible; // default fallback = enabled
    }
}