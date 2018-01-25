<?php
declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Makasim\Yadm\Storage;
use Payum\Core\Payum;
use App\Model\GatewayConfig;
use App\Model\Payment;
use App\Test\ClientTestCase;
use App\Test\ResponseHelper;

class CaptureControllerTest extends ClientTestCase
{
    use ResponseHelper;

    public function testShouldAllowChooseGateway()
    {

        /** @var Storage $gatewayConfigStorage */
        $gatewayConfigStorage = $this->getContainer()->get('payum.gateway_config_storage');

        /** @var GatewayConfig $gatewayConfig */
        $gatewayConfig = $gatewayConfigStorage->create();
        $gatewayConfig->setFactoryName('offline');
        $gatewayConfig->setGatewayName('FooGateway');
        $gatewayConfig->setConfig(['factory' => 'offline']);
        $gatewayConfigStorage->insert($gatewayConfig);

        /** @var GatewayConfig $gatewayConfig */
        $gatewayConfig = $gatewayConfigStorage->create();
        $gatewayConfig->setFactoryName('offline');
        $gatewayConfig->setGatewayName('BarGateway');
        $gatewayConfig->setConfig(['factory' => 'offline']);
        $gatewayConfigStorage->insert($gatewayConfig);

        /** @var Storage $storage */
        $storage = $this->getContainer()->get('payum.payment_storage');

        /** @var Payment $payment */
        $payment = $storage->create();
        $payment->setGatewayName(null);
        $payment->setId(uniqid());

        $storage->insert($payment);

        /** @var Payum $payum */
        $payum = $this->getContainer()->get('payum');

        $token = $payum->getTokenFactory()->createCaptureToken('', $payment, getenv('PAYUM_HTTP_HOST') . '');

        $crawler = $this->getClient()->request('GET', $token->getTargetUrl());

        $this->assertClientResponseStatus(200);
        $this->assertClientResponseContentHtml();

        $this->assertGreaterThan(0, count($crawler->filter('.payum-choose-gateway')));
        $this->assertContains('FooGateway', $crawler->text());
        $this->assertContains('BarGateway', $crawler->text());

        $form = $crawler->filter('form')->form();
        $form['gatewayName'] = 'BarGateway';

        $crawler = $this->getClient()->submit($form);

        $this->assertClientResponseStatus(302);
        $this->assertClientResponseRedirectionStartsWith(getenv('PAYUM_HTTP_HOST') . '?payum_token=');
    }

    public function testShouldObtainMissingDetails()
    {
        /** @var Storage $gatewayConfigStorage */
        $gatewayConfigStorage = $this->getContainer()->get('payum.gateway_config_storage');

        /** @var GatewayConfig $gatewayConfig */
        $gatewayConfig = $gatewayConfigStorage->create();
        $gatewayConfig->setFactoryName('be2bill_offsite');
        $gatewayConfig->setGatewayName('be2bill');
        $gatewayConfig->setConfig([
            'factory' => 'be2bill_offsite',
            'identifier' => 'foo',
            'password' => 'bar',
            'sandbox' => true,
        ]);
        $gatewayConfigStorage->insert($gatewayConfig);

        /** @var Payum $payum */
        $payum = $this->getContainer()->get('payum');

        /** @var Storage $storage */
        $storage = $this->getContainer()->get('payum.payment_storage');

        /** @var Payment $payment */
        $payment = $storage->create();
        $payment->setGatewayName('be2bill');
        $payment->setId(uniqid());

        $storage->insert($payment);

        $token = $payum->getTokenFactory()->createCaptureToken('be2bill', $payment, getenv('PAYUM_HTTP_HOST') . '');

        $crawler = $this->getClient()->request('GET', $token->getTargetUrl());

        $this->assertClientResponseStatus(200);
        $this->assertClientResponseContentHtml();

        $this->assertGreaterThan(0, count($crawler->filter('.payum-obtain-missing-details')));

        $form = $crawler->filter('form')->form();
        $form['payer[email]'] = 'foo@example.com';

        $crawler = $this->getClient()->submit($form);

        $this->assertClientResponseStatus(200);
        $this->assertClientResponseContentHtml();

        $this->assertContains('Redirecting to payment page...', $crawler->text());
    }
}