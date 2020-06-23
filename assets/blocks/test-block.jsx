/* eslint-disable react/prop-types */

import React from 'react';
import { __ } from '@wordpress/i18n';
import { RichText, InspectorControls } from '@wordpress/block-editor';
import classnames from 'classnames';
import styles from './test-block.module.scss';

const edit = (props) => {
  const {
    attributes,
    setAttributes,
    className,
  } = props;

  const handleContentChange = (content) => setAttributes({ content });

  return (
    <>
      <InspectorControls>
        <p>
          {__('Here is some block with inspector control', 'wpify')}
        </p>
      </InspectorControls>
      <div className={classnames(styles.wrapper, className)}>
        <RichText
          tagName="p"
          className={styles.input}
          onChange={handleContentChange}
          value={attributes.content}
        />
      </div>
    </>
  );
};

const save = (props) => {
  const { attributes } = props;
  return (
    <div className="some-class-name">
      <RichText.Content tagName="p" value={attributes.content} />
    </div>
  );
};

const config = {
  title: __('Test block', 'wpify'),
  icon: 'universal-access-alt',
  category: 'wpify',
  attributes: {
    content: {
      type: 'string',
    },
  },
  example: {
    content: __('This is a content of the block', 'wpify'),
  },
  edit,
  save,
};

export default config;
