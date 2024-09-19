import domReady from '@wordpress/dom-ready';
import { BLOCK_STYLES } from './block-styles';
import { registerBlockStyle } from '@wordpress/blocks';

domReady(() => {
    Object.keys(BLOCK_STYLES).forEach((block) =>
        Object.keys(BLOCK_STYLES[block]).forEach((name) =>
            registerBlockStyle(block, {
                name,
                label: BLOCK_STYLES[block][name]
            })
        )
    );
});