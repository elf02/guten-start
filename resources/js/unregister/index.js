import domReady from '@wordpress/dom-ready';
import { unregisterBlockVariation, unregisterBlockType } from '@wordpress/blocks';
import { VARIATIONS } from './variations';
import { BLOCKS } from './blocks';

domReady(() => {
    Object.keys(VARIATIONS).forEach((block) =>
        VARIATIONS[block].forEach((variation) =>
           unregisterBlockVariation(block, variation)
        )
    );

    BLOCKS.forEach((block) => unregisterBlockType(block));
});