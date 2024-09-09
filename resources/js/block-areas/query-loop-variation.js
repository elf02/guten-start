import { registerBlockVariation } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

const queryProps = {
    postType: 'block_area',
    include: [0],
    perPage: 1,
    pages: 0,
    offset: 0,
    order: 'desc',
    orderBy: 'date',
    author: '',
    search: '',
    exclude: [],
    sticky: '',
    inherit: false,
    parents: [],
};

const innerBlocks = [
    [
        'core/post-template',
        {},
        [
            [
                'core/post-content',
                {},
                [],
            ]
        ],
    ]
];

registerBlockVariation('core/query', {
    name: 'gust/block-areas-query-loop',
    title: __('Block-Areas Query Loop'),
    attributes: {
        namespace: 'gust/block-areas-query-loop',
        className: 'block-area',
        align: 'full',
        query: queryProps
    },
    allowedControls: [],
    innerBlocks: innerBlocks,
    isActive: ['namespace']
});