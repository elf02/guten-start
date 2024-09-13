import domReady from '@wordpress/dom-ready';
import { unregisterBlockVariation, unregisterBlockType } from '@wordpress/blocks';
import { VARIATIONS } from './variations';
import { BLOCKS } from './blocks';

domReady(() => {
    VARIATIONS.forEach((variation) => {
        unregisterBlockVariation(variation.block, variation.name);
    });

    BLOCKS.forEach((block) => {
        unregisterBlockType(block);
    });
});