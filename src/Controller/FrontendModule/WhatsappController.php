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

        if (!$this->isWhatsappVisible($page, $model)) {
            return new Response();
        }

        $whatsappData = [       
            'title' => null,
            'number' => null,
            'message' => null,
        ];

        while ($page !== null) {
    
            // Set only if not already set and the page value is non-empty
            if (empty($whatsappData['title']) && !empty(trim((string)$page->whatsappTitle))) {
                $whatsappData['title'] = $page->whatsappTitle;
            }

            if (empty($whatsappData['number']) && !empty(trim((string)$page->whatsappNumber))) {
                $whatsappData['number'] = $page->whatsappNumber;
            }

            if (empty($whatsappData['message']) && !empty(trim((string)$page->whatsappMessage))) {
                $whatsappData['message'] = $page->whatsappMessage;
            }

            // If all are filled, break
            if (!empty($whatsappData['title']) && !empty($whatsappData['number']) && !empty($whatsappData['message'])) {
                break;
            }
    
            // If all values are found, break
            if ($whatsappData['title'] && $whatsappData['number'] && $whatsappData['message']) {
                break;
            }

            // Move to parent
            $page = PageModel::findById($page->pid);
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