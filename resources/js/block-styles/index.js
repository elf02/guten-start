import domReady from '@wordpress/dom-ready';

import { __ } from '@wordpress/i18n';

import {
    registerBlockStyle,
    unregisterBlockStyle
} from '@wordpress/blocks';

const BLOCK_STYLES = {
    'core/social-links': {
        'outline': __('Outline', 'guten-start')
    }
};

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