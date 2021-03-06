<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector;

use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Facade\JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Dependency\Service\JellyfishSalesOrderPayoneGiftCardConnectorToPayoneService;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \Spryker\Zed\Sales\SalesConfig getConfig()
 */
class JellyfishSalesOrderPayoneGiftCardConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_PAYONE = 'SERVICE_PAYONE';

    /**
     * @var string
     */
    public const FACADE_SALES = 'FACADE_SALES';

    /**
     * @var string
     */
    public const FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR = 'FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addSalesFacade($container);
        $container = $this->addPayoneService($container);
        $container = $this->addGiftCardProportionalValueFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container)
    {
        $container[static::FACADE_SALES] = function (Container $container) {
            return new JellyfishSalesOrderPayoneGiftCardConnectorToSalesFacadeBridge($container->getLocator()->sales()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardProportionalValueFacade(Container $container)
    {
        $container[static::FACADE_GIFT_CARD_PROPORTIONAL_VALUE_CONNECTOR] = function (Container $container) {
            return new JellyfishSalesOrderPayoneGiftCardConnectorToGiftCardProportionalValueFacadeBridge($container->getLocator()->giftCardProportionalValue()->facade());
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addPayoneService(Container $container)
    {
        $container[static::SERVICE_PAYONE] = function (Container $container) {
            return new JellyfishSalesOrderPayoneGiftCardConnectorToPayoneService($container->getLocator()->payone()->service());
        };

        return $container;
    }
}
