/**
 * WordPress dependencies
 */
const { registerBlockType } = wp.blocks;

// Category slug and title
const category = {
	slug: 'common',
};

import * as highlight from './blocks/highlight';
import * as clickToTweet from './blocks/click-to-tweet';
import * as pluginCard from './blocks/plugin-card';

export function registerBlocks () {
	[
		highlight,
		clickToTweet,
		pluginCard,
	].forEach( ( block ) => {

		if ( ! block ) {
			return;
		}

		const { name, icon, settings } = block;

		registerBlockType( `machothemes/${ name }`, { category: category.slug, icon: { src: icon }, ...settings } );
	} );
};
registerBlocks();

