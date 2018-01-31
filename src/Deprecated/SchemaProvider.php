<?php
namespace App\Schema;

//use App\Schema\Controller\GatewaySchemaController;
//use App\Schema\Controller\PaymentSchemaController;
//use App\Schema\Controller\TokenSchemaController;
//use Silex\Application as SilexApplication;
//use Silex\ControllerCollection;
//use Silex\ServiceProviderInterface;

class SchemaProvider implements ServiceProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function register(SilexApplication $app)
    {
//        $app['app.schema.controller.gateways'] = $app->share(function() use ($app) {
//            return new GatewaySchemaController($app['payum.gateway_schema_builder'], $app['payum.gateway_form_definition_builder']);
//        });
//
//        $app['app.schema.controller.payments'] = $app->share(function() use ($app) {
//            return new PaymentSchemaController($app['payum.payment_schema_builder'], $app['payum.payment_form_definition_builder']);
//        });
//
//        $app['app.schema.controller.tokens'] = $app->share(function() use ($app) {
//            return new TokenSchemaController($app['payum.token_schema_builder']);
//        });
//
//        $app['payum.gateway_schema_builder'] = $app->share(function() use ($app) {
//            return new GatewaySchemaBuilder($app['payum']);
//        });
//
//        $app['payum.gateway_form_definition_builder'] = $app->share(function() use ($app) {
//            return new GatewayFormDefinitionBuilder($app['payum']);
//        });
//
//        $app['payum.payment_schema_builder'] = $app->share(function() use ($app) {
//            return new PaymentSchemaBuilder($app['payum.yadm_gateway_config_storage']);
//        });
//
//        $app['payum.payment_form_definition_builder'] = $app->share(function() use ($app) {
//            return new PaymentFormDefinitionBuilder($app['payum.yadm_gateway_config_storage']);
//        });
//
//        $app['payum.token_schema_builder'] = $app->share(function() use ($app) {
//            return new TokenSchemaBuilder();
//        });
//
//        /** @var ControllerCollection $schema */
//        $schema = $app['controllers_factory'];
//        $schema->get('/gateways/default.json', 'app.schema.controller.gateways:getDefaultAction');
//        $schema->get('/gateways/form/default.json', 'app.schema.controller.gateways:getDefaultFormAction');
//        $schema->get('/gateways/{name}.json', 'app.schema.controller.gateways:getAction');
//        $schema->get('/gateways/form/{name}.json', 'app.schema.controller.gateways:getFormAction');
//
//        $schema->get('/payments/new.json', 'app.schema.controller.payments:getNewAction');
//        $schema->get('/payments/form/new.json', 'app.schema.controller.payments:getNewFormAction');
//
//        $schema->get('/tokens/new.json', 'app.schema.controller.tokens:getNewAction');
//
//        $app->mount('/schema', $schema);
    }
//
//    /**
//     * {@inheritDoc}
//     */
//    public function boot(SilexApplication $app)
//    {
//    }
}
