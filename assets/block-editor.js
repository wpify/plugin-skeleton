import domReady from '@wordpress/dom-ready';
import { registerBlockType, registerBlockStyle, unregisterBlockStyle } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import testBlock from './blocks/test-block';
import './block-editor.scss';

domReady(() => {
  // Blocks

  registerBlockType('wpify/test-block', testBlock);

  // Block styles

  unregisterBlockStyle('core/quote', 'large');

  registerBlockStyle('core/paragraph', {
    name: 'wpify-style',
    label: __('WPify style', 'wpify'),
  });
});
