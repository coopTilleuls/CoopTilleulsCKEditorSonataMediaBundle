<?php

/*
 * This file is part of the CKEditorSonataMediaBundle package.
 *
 * (c) La Coopérative des Tilleuls <contact@les-tilleuls.coop>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CoopTilleuls\Bundle\CKEditorSonataMediaBundle\Controller;

use Sonata\MediaBundle\Controller\MediaAdminController as BaseMediaAdminController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Adds browser and upload actions
 *
 * @author Kévin Dunglas <kevin@les-tilleuls.coop>
 */
class MediaAdminController extends BaseMediaAdminController
{

    /**
     * Gets a template
     *
     * @param  string $name
     * @return string
     */
    private function getTemplate($name)
    {
        $templates = $this->container->getParameter('coop_tilleuls_ck_editor_sonata_media.configuration.templates');

        if (isset($templates[$name])) {
            return $templates[$name];
        }

        return null;
    }

    /**
     * Returns the response object associated with the browser action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws AccessDeniedException
     */
    public function browserAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $datagrid = $this->admin->getDatagrid();
        $datagrid->setValue('context', null, $this->admin->getPersistentParameter('context'));
        $datagrid->setValue('providerName', null, $this->admin->getPersistentParameter('provider'));

        // Store formats
        $formats = array();
        foreach ($datagrid->getResults() as $media) {
            $formats[$media->getId()] = $this->get('sonata.media.pool')->getFormatNamesByContext($media->getContext());
        }

        $formView = $datagrid->getForm()->createView();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->getTemplate('browser'), array(
            'action' => 'browser',
            'form' => $formView,
            'datagrid' => $datagrid,
            'formats' => $formats,
            'base_template' => $this->getTemplate('layout')
        ));
    }

    /**
     * Returns the response object associated with the upload action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws AccessDeniedException
     */
    public function uploadAction()
    {
        if (false === $this->admin->isGranted('CREATE')) {
            throw new AccessDeniedException();
        }

        $mediaManager = $this->get('sonata.media.manager.media');

        $request = $this->getRequest();
        $provider = $request->get('provider');
        $file = $request->files->get('upload');

        if (!$request->isMethod('POST') || !$provider || null === $file) {
            throw $this->createNotFoundException();
        }

        $context = $request->get('context', $this->get('sonata.media.pool')->getDefaultContext());

        $media = $mediaManager->create();
        $media->setBinaryContent($file);

        $mediaManager->save($media, $context, $provider);
        $this->admin->createObjectSecurity($media);

        return $this->render($this->getTemplate('upload'), array(
            'action' => 'list',
            'object' => $media
        ));
    }

}
