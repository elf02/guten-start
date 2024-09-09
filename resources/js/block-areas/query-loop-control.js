import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { addFilter } from '@wordpress/hooks';
import { useSelect } from '@wordpress/data';


const withQueryLoopControl = (BlockEdit) => (props) => {
    const { attributes, setAttributes } = props;

    if (props.attributes?.namespace === 'gust/block-areas-query-loop') {
        const { query } = attributes;

        const blockAreas = useSelect((select) => {
            return select('core').getEntityRecords('postType', 'block_area', { per_page: -1, status: 'publish' });
        });

        return (
            <>
                <InspectorControls>
                    <PanelBody title={__('Block Area', 'gust')}>
                        <SelectControl
                            value={query?.include[0] || 0}
                            options={blockAreas ? [
                                { label: __('Select...', 'gust'), value: 0 },
                                ...blockAreas.map(({ id, title: { rendered: postTitle } }) => {
                                    return { label: postTitle, value: id };
                                })
                            ] : []}
                            onChange={(value) => {
                                setAttributes({
                                    query: {
                                        ...query,
                                        'include': [parseInt(value)]
                                    }
                                });
                            }}
                        />
                    </PanelBody>
                </InspectorControls>
                <BlockEdit {...props} />
            </>
        );
    }

    return <BlockEdit {...props} />
};
addFilter('editor.BlockEdit', 'gust/block-areas-query-loop-edit', withQueryLoopControl);