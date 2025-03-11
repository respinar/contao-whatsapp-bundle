<?php

declare(strict_types=1);

namespace Respinar\ContaoWhatsappBundle\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\StringUtil;

#[AsFrontendModule(category: "miscellaneous", type: "whatsapp", template: "mod_whatsapp")]
class WhatsappController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        // Check if the current page has WhatsApp fields set
        $page = $this->getPageModel();

        if ($page->whatsappDisabled) {
            return new Response();
        }

        // Assign data to the template
        $template->whatsappTitle = $page->whatsappTitle ?: $model->whatsappTitle;
        $template->whatsappNumber = $page->whatsappNumber ?: $model->whatsappNumber;
        $template->whatsappMessage = $page->whatsappMessage ?: $model->whatsappMessage;
        $template->cssClass = StringUtil::deserialize($model->cssID)[1] ?? '';
        $template->searchable = False;

        // Add JavaScript file to the page
        $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/contaowhatsapp/js/whatsapp.js|static';

        return $template->getResponse();
    }
}