<?php

namespace Ekyna\Bundle\AgendaBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExampleController
 * @package Ekyna\Bundle\AgendaBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ExampleController extends Controller
{
    /**
     * Example index page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $currentPage = $request->query->get('page', 1);
        $repo = $this->get('ekyna_agenda.event.repository');
        $pager = $repo->createPager($currentPage, 12);

        return $this->render('EkynaAgendaBundle:Example:index.html.twig', array(
            'pager'  => $pager,
            'events' => $pager->getCurrentPageResults(),
        ));
    }

    /**
     * Example detail page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     */
    public function detailAction(Request $request)
    {
        $repo = $this->get('ekyna_agenda.event.repository');

        $event = $repo->findOneBySlug($request->attributes->get('slug'));

        if (null === $event) {
            throw new NotFoundHttpException('Event not found.');
        }

        $latest = $repo->findLatest();

        return $this->render('EkynaAgendaBundle:Example:detail.html.twig', array(
            'event' => $event,
            'latest' => $latest,
        ));
    }
}