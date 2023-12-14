<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Controller;

use Exchange\Application\Form\Convert\ConvertCurrencyType;
use Exchange\Application\Form\List\MinMaxRateType;
use Exchange\Application\Query\ConvertCurrencyQuery;
use Exchange\Application\Query\MinMaxRateQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class CurrencyController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function minMaxRate(Request $request): Response
    {
        $form = $this->createForm(MinMaxRateType::class);
        $form->handleRequest($request);
        $result = [];

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $query = new MinMaxRateQuery(
                    $form->getData()['currency'],
                    $form->getData()['timeRange']
                );
                $envelope = $this->messageBus->dispatch($query);
                $handledStamp = $envelope->last(HandledStamp::class);

                $result = $handledStamp->getResult();
            } catch (\Exception $e) {
                return new Response('Something went wrong. Try later', 500);
            }
        }

        return $this->render('currency/list/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result
        ]);
    }

    public function convertRate(Request $request): Response
    {
        $form = $this->createForm(ConvertCurrencyType::class);
        $form->handleRequest($request);
        $result = [];

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $query = new ConvertCurrencyQuery(
                    $form->getData()['amount'],
                    $form->getData()['from'],
                    $form->getData()['to']
                );
                $envelope = $this->messageBus->dispatch($query);
                $handledStamp = $envelope->last(HandledStamp::class);

                $result = $handledStamp->getResult();
            } catch (\Exception $e) {
                return new Response('Something went wrong. Try later', 500);
            }
        }

        return $this->render('currency/convert/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result
        ]);
    }
}
