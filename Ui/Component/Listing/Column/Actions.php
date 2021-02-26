<?php

namespace Lof\CustomProduct\Ui\Component\Listing\Column;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{

    const URL_PATH_VIEW = 'lofcustomproduct/order/view';
    // const URL_PATH_VIEW = 'lofpos/orders/orders';

    protected $urlBuilder;


    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = [
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_VIEW,
                                [
                                    'entity_id' => $item['entity_id']
                                ]
                            ),
                            'label' => __('View'),
                            'popup' => true
                        ]
                ];
                }
            }
        }

        return $dataSource;
    }
}
