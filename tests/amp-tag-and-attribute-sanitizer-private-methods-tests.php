<?php

require_once( AMP__DIR__ . '/includes/sanitizers/class-amp-allowed-tags-generated.php' );

class AMP_Tag_And_Attribute_Sanitizer_Attr_Spec_Rules_Test extends WP_UnitTestCase {

	protected $allowed_tags;
	protected $globally_allowed_attrs;
	protected $layout_allowed_attrs;

	public function setUp() {
		$this->allowed_tags = apply_filters( 'amp_allowed_tags', AMP_Allowed_Tags_Generated::get_allowed_tags() );
		$this->globally_allowed_attributes = apply_filters( 'amp_globally_allowed_attributes', AMP_Allowed_Tags_Generated::get_allowed_attributes() );
		$this->layout_allowed_attributes = apply_filters( 'amp_globally_allowed_attributes', AMP_Allowed_Tags_Generated::get_allowed_attributes() );
	}
	
	public function get_attr_spec_rule_data() {
		return array(
			'test_attr_spec_rule_mandatory_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'src',
					'attribute_value' => '/path/to/resource',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_mandatory',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_mandatory_alternate_attr_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'src',
					'use_alternate_name' => 'srcset',
					'attribute_value' => '/path/to/resource',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_mandatory',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_mandatory_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'src',
					'attribute_value' => '/path/to/resource',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_mandatory',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_mandatory_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'alt',
					'attribute_value' => 'alternate',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_mandatory',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),



			'test_attr_spec_rule_value_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'template',
					'attribute_name' => 'type',
					'attribute_value' => 'amp-mustache',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_value_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'template',
					'attribute_name' => 'type',
					'attribute_value' => 'invalid',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_value_not_applicable' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'template',
					'attribute_name' => 'type',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_value',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),




			'test_attr_spec_rule_value_casei_lower_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'type',
					'attribute_value' => 'text/html',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_casei',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_value_casei_upper_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'type',
					'attribute_value' => 'TEXT/HTML',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_casei',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_value_casei_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'type',
					'attribute_value' => 'invalid',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_casei',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_value_casei_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'template',
					'attribute_name' => 'type',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_value_casei',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),



			'test_attr_spec_rule_value_regex_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'target',
					'attribute_value' => '_blank',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_regex',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_value_regex_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'target',
					'attribute_value' => '_blankzzz',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_regex',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_value_regex_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'target',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_value_regex',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),



			'test_attr_spec_rule_value_regex_casei_lower_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-playbuzz',
					'attribute_name' => 'data-comments',
					'attribute_value' => 'false',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_regex_casei',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_value_regex_casei_upper_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-playbuzz',
					'attribute_name' => 'data-comments',
					'attribute_value' => 'FALSE',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_regex_casei',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_value_regex_casei_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-playbuzz',
					'attribute_name' => 'data-comments',
					'attribute_value' => 'invalid',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_value_regex_casei',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_value_regex_casei_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-playbuzz',
					'attribute_name' => 'data-comments',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_value_regex_casei',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),




			'test_attr_spec_rule_allowed_protocol_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'href',
					'attribute_value' => 'http://example.com',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_allowed_protocol_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'href',
					'attribute_value' => 'evil://example.com',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_allowed_protocol_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'href',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),


			'test_attr_spec_rule_allowed_protocol_srcset_single_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'http://veryunique.com/img.jpg',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_allowed_protocol_srcset_multiple_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'http://example.com/img.jpg, https://example.com/whatever.jpg, image.jpg',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_allowed_protocol_srcset_single_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'bad://example.com/img.jpg',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_allowed_protocol_srcset_multiple_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'bad://example.com/img.jpg, evil://example.com/whatever.jpg',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_allowed_protocol_srcset_multiple_fail_good_first' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'https://example.com/img.jpg, evil://example.com/whatever.jpg',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_allowed_protocol_srcset_multiple_fail_bad_first' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'evil://example.com/img.jpg, https://example.com/whatever.jpg',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_allowed_protocol_srcset_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-img',
					'attribute_name' => 'srcset',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_allowed_protocol',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),




			'test_attr_spec_rule_disallowed_relative_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'data-share-endpoint',
					'attribute_value' => 'http://example.com',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_relative',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_disallowed_relative_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'data-share-endpoint',
					'attribute_value' => '//example.com',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_relative',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_disallowed_relative_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'data-share-endpoint',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_disallowed_relative',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),



			'test_attr_spec_rule_disallowed_empty_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-user-notification',
					'attribute_name' => 'data-dismiss-href',
					'attribute_value' => 'https://example.com',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_empty',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_disallowed_empty_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-user-notification',
					'attribute_name' => 'data-dismiss-href',
					'attribute_value' => '',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_empty',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_disallowed_empty_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-user-notification',
					'attribute_name' => 'data-dismiss-href',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_disallowed_empty',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),



			'test_attr_spec_rule_disallowed_domain_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'form',
					'attribute_name' => 'action',
					'attribute_value' => 'https://example.com',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_domain',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_disallowed_domain_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'form',
					'attribute_name' => 'action',
					'attribute_value' => '//cdn.ampproject.org',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_domain',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_disallowed_domain_fail_2' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'form',
					'attribute_name' => 'action',
					'attribute_value' => 'https://cdn.ampproject.org',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_disallowed_domain',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_disallowed_domain_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'form',
					'attribute_name' => 'action',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_disallowed_domain',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),




			'test_attr_spec_rule_blacklisted_value_regex_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'rel',
					'attribute_value' => 'whatever',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_blacklisted_value_regex',
				),
				'expected' => AMP_Rule_Spec::pass,
			),
			'test_attr_spec_rule_blacklisted_value_regex_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'rel',
					'attribute_value' => 'components',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_blacklisted_value_regex',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_blacklisted_value_regex_fail_2' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'rel',
					'attribute_value' => 'import',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'check_attr_spec_rule_blacklisted_value_regex',
				),
				'expected' => AMP_Rule_Spec::fail,
			),
			'test_attr_spec_rule_blacklisted_value_regex_na' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'a',
					'attribute_name' => 'rel',
					'attribute_value' => 'invalid',
					'include_attr' => false,
					'include_attr_value' => false,
					'func_name' => 'check_attr_spec_rule_blacklisted_value_regex',
				),
				'expected' => AMP_Rule_Spec::not_applicable,
			),
		);
	}

	/**
	 * @dataProvider get_attr_spec_rule_data
	 * @group allowed-tags-private-methods
	 */
	public function test_validate_attr_spec_rules( $data, $expected ) {

		if ( isset( $data['include_attr_value'] ) && $data['include_attr_value'] ) {
			$attr_value = '="' . $data['attribute_value'] . '"';
		} else {
			$attr_value = '';
		}
		if ( isset( $data['use_alternate_name'] ) && $data['use_alternate_name'] && $data['include_attr'] ) {
			$attribute = $data['use_alternate_name'] . $attr_value;
		} elseif ( isset( $data['include_attr'] ) && $data['include_attr'] ) {
			$attribute = $data['attribute_name'] . $attr_value;
		} else {
			$attribute = '';
		}

		$source = '<' . $data['tag_name'] . ' ' . $attribute . '>Some test content</' . $data['tag_name'] . '>';

		$attr_spec_list = $this->allowed_tags[ $data['tag_name'] ][$data['rule_spec_index']]['attr_spec_list'];
		foreach( $attr_spec_list as $attr_name => $attr_val ) {
			if ( isset( $attr_spec_list[ $attr_name ][AMP_Rule_Spec::alternative_names] ) ) {
				foreach( $attr_spec_list[ $attr_name ][AMP_Rule_Spec::alternative_names] as $attr_alt_name ) {
					$attr_spec_list[ $attr_alt_name ] = $attr_spec_list[ $attr_name ];
				}
			}
		}

		$attr_spec_rule = $attr_spec_list[ $data['attribute_name'] ];

		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );
		$this->invoke_method( $sanitizer, 'get_whitelist_data' );
		$node = $dom->getElementsByTagName( $data['tag_name'] )->item( 0 );

		$got = $this->invoke_method( $sanitizer, $data['func_name'], array( $node, $data['attribute_name'], $attr_spec_rule ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $source );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_is_allowed_attribute_data() {
		return array(
			'test_is_amp_allowed_attribute_whitelisted_regex_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'data-whatever-else-you-want',
					'attribute_value' => 'whatever',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_global_attribute_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'itemid',
					'attribute_value' => 'whatever',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_tag_spec_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'media',
					'attribute_value' => 'whatever',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_disallowed_attr_fail' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-social-share',
					'attribute_name' => 'bad-attr',
					'attribute_value' => 'whatever',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => false,
			),

			'test_is_amp_allowed_attribute_layout_height_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-ad',
					'attribute_name' => 'height',
					'attribute_value' => 'not_tested',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_layout_heights_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-ad',
					'attribute_name' => 'heights',
					'attribute_value' => 'not_tested',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_layout_width_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-ad',
					'attribute_name' => 'width',
					'attribute_value' => 'not_tested',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_layout_sizes_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-ad',
					'attribute_name' => 'sizes',
					'attribute_value' => 'not_tested',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
			'test_is_amp_allowed_attribute_layout_layout_pass' => array(
				array(
					'rule_spec_index' => 0,
					'tag_name' => 'amp-ad',
					'attribute_name' => 'layout',
					'attribute_value' => 'not_tested',
					'include_attr' => true,
					'include_attr_value' => true,
					'func_name' => 'is_amp_allowed_attribute',
				),
				'expected' => true,
			),
		);
	}

	/**
	 * @dataProvider get_is_allowed_attribute_data
	 * @group allowed-tags-private-methods
	 */
	public function test_is_allowed_attribute( $data, $expected ) {

		if ( isset( $data['include_attr_value'] ) && $data['include_attr_value'] ) {
			$attr_value = '="' . $data['attribute_value'] . '"';
		} else {
			$attr_value = '';
		}
		if ( isset( $data['use_alternate_name'] ) && $data['use_alternate_name'] && $data['include_attr'] ) {
			$attribute = $data['use_alternate_name'] . $attr_value;
		} elseif ( isset( $data['include_attr'] ) && $data['include_attr'] ) {
			$attribute = $data['attribute_name'] . $attr_value;
		} else {
			$attribute = '';
		}
		$source = '<' . $data['tag_name'] . ' ' . $attribute . '>Some test content</' . $data['tag_name'] . '>';

		$attr_spec_list = $this->allowed_tags[ $data['tag_name'] ][$data['rule_spec_index']]['attr_spec_list'];
		foreach( $attr_spec_list as $attr_name => $attr_val ) {
			if ( isset( $attr_spec_list[ $attr_name ][AMP_Rule_Spec::alternative_names] ) ) {
				foreach( $attr_spec_list[ $attr_name ][AMP_Rule_Spec::alternative_names] as $attr_alt_name ) {
					$attr_spec_list[ $attr_alt_name ] = $attr_spec_list[ $attr_name ];
				}
			}
		}

		$dom = AMP_DOM_Utils::get_dom_from_content( $source );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );
		$this->invoke_method( $sanitizer, 'get_whitelist_data' );
		$node = $dom->getElementsByTagName( $data['tag_name'] )->item( 0 );

		$got = $this->invoke_method( $sanitizer, $data['func_name'], array( $data['attribute_name'], $attr_spec_list ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $source );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_remove_node_data() {
		return array(
			'remove_single_bad_tag' => array(
				array(
					'source' => '<bad-tag></bad-tag>',
					'tag_name' => 'bad-tag',
				),
				'',
			),
			'remove_bad_tag_with_single_empty_parent' => array(
				array(
					'source' => '<div><bad-tag></bad-tag></div>',
					'tag_name' => 'bad-tag',
				),
				'',
			),
			'remove_bad_tag_with_multiple_empty_parents' => array(
				array(
					'source' => '<div><p><bad-tag></bad-tag></p></div>',
					'tag_name' => 'bad-tag',
				),
				'',
			),
			'remove_bad_tag_leave_siblings' => array(
				array(
					'source' => '<bad-tag></bad-tag><p>Good Data</p>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'remove_bad_tag_and_empty_parent_leave_parent_siblings' => array(
				array(
					'source' => '<div><bad-tag></bad-tag></div><p>Good Data</p>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'remove_bad_tag_and_multiple_empty_parent_leave_parent_siblings' => array(
				array(
					'source' => '<div><div><bad-tag></bad-tag></div></div><p>Good Data</p>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'remove_bad_tag_leave_empty_siblings_and_parent' => array(
				array(
					'source' => '<div><br/><bad-tag></bad-tag></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><br/></div>',
			),
			'remove_single_bad_tag_with_non-empty_parent' => array(
				array(
					'source' => '<div><bad-tag></bad-tag><p>Good Data</p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
			'remove_bad_tag_and_empty_parent_leave_non-empty_grandparent' => array(
				array(
					'source' => '<div><div><bad-tag></bad-tag></div><p>Good Data</p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
			'remove_bad_tag_and_empty_grandparent_leave_non-empty_greatgrandparent' => array(
				array(
					'source' => '<div><div><div><bad-tag></bad-tag></div></div><p>Good Data</p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
		);
	}

	/**
	 * @dataProvider get_remove_node_data
	 * @group allowed-tags-private-methods
	 */
	public function test_remove_node( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );
		$node = $dom->getElementsByTagName( $data['tag_name'] )->item( 0 );
		
		$this->invoke_method( $sanitizer, 'remove_node', array( $node ) );

		$got = AMP_DOM_Utils::get_content_from_dom( $dom );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
			printf( 'got = %s' .PHP_EOL, $got );
		}

		$this->assertEquals( $expected, $got );
	}


	public function get_replace_node_with_children_data() {
		return array(
			'text_child' => array(
				array(
					'source' => '<bad-tag>Good Data</bad-tag>',
					'tag_name' => 'bad-tag',
				),
				'Good Data',
			),
			'comment_child' => array(
				array(
					'source' => '<bad-tag><!-- Good Data --></bad-tag>',
					'tag_name' => 'bad-tag',
				),
				'<!-- Good Data -->',
			),
			'single_child' => array(
				array(
					'source' => '<bad-tag><p>Good Data</p></bad-tag>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'multiple_children' => array(
				array(
					'source' => '<bad-tag><p>Good Data</p><p>More Good Data</p></bad-tag>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p><p>More Good Data</p>',
			),
			'no_children' => array(
				array(
					'source' => '<bad-tag></bad-tag>',
					'tag_name' => 'bad-tag',
				),
				'',
			),
			'children_with_empty_parent' => array(
				array(
					'source' => '<div><bad-tag>Good Data</bad-tag></div>',
					'tag_name' => 'bad-tag',
				),
				'<div>Good Data</div>',
			),
			'no_children_empty_parent' => array(
				array(
					'source' => '<div><bad-tag></bad-tag></div>',
					'tag_name' => 'bad-tag',
				),
				'',
			),
			'children_multiple_empty_parents' => array(
				array(
					'source' => '<div><p><bad-tag>Good Data</bad-tag></p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
			'no_children_multiple_empty_parents' => array(
				array(
					'source' => '<div><p><bad-tag></bad-tag></p></div>',
					'tag_name' => 'bad-tag',
				),
				'',
			),
			'no_children_leave_siblings' => array(
				array(
					'source' => '<bad-tag></bad-tag><p>Good Data</p>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'no_children_and_empty_parent_leave_parent_siblings' => array(
				array(
					'source' => '<div><bad-tag></bad-tag></div><p>Good Data</p>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'no_children_and_multiple_empty_parent_leave_parent_siblings' => array(
				array(
					'source' => '<div><div><bad-tag></bad-tag></div></div><p>Good Data</p>',
					'tag_name' => 'bad-tag',
				),
				'<p>Good Data</p>',
			),
			'no_children_leave_empty_siblings_and_parent' => array(
				array(
					'source' => '<div><br/><bad-tag></bad-tag></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><br/></div>',
			),
			'no_childreng_with_non-empty_parent' => array(
				array(
					'source' => '<div><bad-tag></bad-tag><p>Good Data</p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
			'no_children_and_empty_parent_leave_non-empty_grandparent' => array(
				array(
					'source' => '<div><div><bad-tag></bad-tag></div><p>Good Data</p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
			'no_children_and_empty_grandparent_leave_non-empty_greatgrandparent' => array(
				array(
					'source' => '<div><div><div><bad-tag></bad-tag></div></div><p>Good Data</p></div>',
					'tag_name' => 'bad-tag',
				),
				'<div><p>Good Data</p></div>',
			),
		);
	}

	/**
	 * @dataProvider get_replace_node_with_children_data
	 * @group allowed-tags-private-methods
	 */
	public function test_replace_node_with_children( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );
		$node = $dom->getElementsByTagName( $data['tag_name'] )->item( 0 );
		
		$this->invoke_method( $sanitizer, 'replace_node_with_children', array( $node ) );

		$got = AMP_DOM_Utils::get_content_from_dom( $dom );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
			printf( 'got = %s' .PHP_EOL, $got );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_ancestor_with_tag_name_data() {
		return array(
			'empty' => array(
				array(
					'source' => '',
					'node_tag_name' => 'p',
					'ancestor_tag_name' => 'article',
				),
				null
			),
			'ancestor_is_immediate_parent' => array(
				array(
					'source' => '<article><p>Good Data</p><article>',
					'node_tag_name' => 'p',
					'ancestor_tag_name' => 'article',
				),
				'article'
			),
			'ancestor_is_distant_parent' => array(
				array(
					'source' => '<article><div><div><div><p>Good Data</p></div></div></div><article>',
					'node_tag_name' => 'p',
					'ancestor_tag_name' => 'article',
				),
				'article'
			),
			'ancestor_does_not_exist' => array(
				array(
					'source' => '<div><div><div><p>Good Data</p></div></div></div>',
					'node_tag_name' => 'p',
					'ancestor_tag_name' => 'article',
				),
				null
			),
		);
	}

	/**
	 * @dataProvider get_ancestor_with_tag_name_data
	 * @group allowed-tags-private-methods
	 */
	public function test_get_ancestor_with_tag_name( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		if ( $expected ) {
			$ancestor_node = $dom->getElementsByTagName( $expected )->item( 0 );
		} else {
			$ancestor_node = null;
		}
		
		$got = $this->invoke_method( $sanitizer, 'get_ancestor_with_tag_name', array( $node, $data['ancestor_tag_name'] ) );

		if ( $ancestor_node != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $ancestor_node, $got );
	}

	public function get_validate_attr_spec_list_for_node_data() {
		return array(
			'no_attributes' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(),
				),
				0,
			),
			'attributes_no_spec' => array(
				array(
					'source' => '<div attribute1 attribute2 attribute3></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(),
				),
				0,
			),
			'attributes_alternative_names' => array(
				array(
					'source' => '<div attribute1 attribute2 attribute3></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'alternative_names' => array(
								'attribute1_alternative1',
								'attribute1_alternative2',
								'attribute1_alternative3',
							),
						),
					),
				),
				0,
			),
			'attributes_mandatory' => array(
				array(
					'source' => '<div attribute1 attribute2 attribute3></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'mandatory' => true,
						),
					),
				),
				1,
			),
			'attributes_mandatory_alternative_name' => array(
				array(
					'source' => '<div attribute1_alternative1 attribute2 attribute3></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'mandatory' => true,
							'alternative_names' => array(
								'attribute1_alternative1',
								'attribute1_alternative2',
								'attribute1_alternative3',
							),
						),
					),
				),
				1,
			),
			'attributes_value' => array(
				array(
					'source' => '<div attribute1="required_value"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'value' => 'required_value',
						),
					),
				),
				1,
			),
			'attributes_value_regex' => array(
				array(
					'source' => '<div attribute1="this"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'value_regex' => '(this|that)',
						),
					),
				),
				1,
			),
			'attributes_value_casei' => array(
				array(
					'source' => '<div attribute1="VALUE"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'value_casei' => 'value',
						),
					),
				),
				1,
			),
			'attributes_value_regex_casei' => array(
				array(
					'source' => '<div attribute1="THIS"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'value_regex_casei' => '(this|that)',
						),
					),
				),
				1,
			),
			'attributes_allowed_protocol_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'allowed_protocol' => array(
								'http',
								'https',
							),
						),
					),
				),
				1,
			),
			'attributes_allowed_protocol_fail' => array(
				array(
					'source' => '<div attribute1="bad://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'allowed_protocol' => array(
								'http',
								'https',
							),
						),
					),
				),
				0,
			),
			'attributes_allow_relative_false_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'allow_relative' => false,
						),
					),
				),
				1,
			),
			'attributes_allow_relative_false_fail' => array(
				array(
					'source' => '<div attribute1="/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'allow_relative' => false,
						),
					),
				),
				0,
			),
			'attributes_allow_empty_false_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'allow_empty' => false,
						),
					),
				),
				1,
			),
			'attributes_allow_empty_false_fail' => array(
				array(
					'source' => '<div attribute1></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'allow_empty' => false,
						),
					),
				),
				0,
			),
			'attributes_disallowed_domain_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'disallowed_domain' => array(
								'dis.allow.ed'
							),
						),
					),
				),
				1,
			),
			'attributes_disallowed_domain_fail' => array(
				array(
					'source' => '<div attribute1="http://dis.allow.ed/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'disallowed_domain' => array(
								'dis.allow.ed'
							),
						),
					),
				),
				0,
			),
			'attributes_blacklisted_regex' => array(
				array(
					'source' => '<div attribute1="blacklisted_value"></div>',
					'node_tag_name' => 'div',
					'attr_spec_list' => array(
						'attribute1' => array(
							'blacklisted_value_regex' => 'blacklisted_value',
							'alternative_names' => array(
								'attribute1_alternative1',
								'attribute1_alternative2',
								'attribute1_alternative3',
							),
						),
					),
				),
				0,
			),
		);
	}

	/**
	 * @dataProvider get_validate_attr_spec_list_for_node_data
	 * @group allowed-tags-private-methods
	 */
	public function test_validate_attr_spec_list_for_node( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		
		$got = $this->invoke_method( $sanitizer, 'validate_attr_spec_list_for_node', array( $node, $data['attr_spec_list'] ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_check_attr_spec_rule_value_data() {
		return array(
			'no_attributes' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'value_pass' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => 'value1',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_fail' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => 'valuex',
					),
				),
				AMP_Rule_Spec::fail,
			),
			'value_no_attr' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => 'value1',
					),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'value_empty_pass1' => array(
				array(
					'source' => '<div attribute1=""></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => '',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_empty_pass2' => array(
				array(
					'source' => '<div attribute1></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => '',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_empty_fail' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => '',
					),
				),
				AMP_Rule_Spec::fail,
			),
			'value_alternative_attr_name_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => 'value1',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_alternative_attr_name_fail' => array(
				array(
					'source' => '<div attribute1_alternative1="value2"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value' => 'value1',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
		);
	}

	/**
	 * @dataProvider get_check_attr_spec_rule_value_data
	 * @group allowed-tags-private-methods
	 */
	public function test_check_attr_spec_rule_value( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );

		$got = $this->invoke_method( $sanitizer, 'check_attr_spec_rule_value', array( $node, $data['attr_name'], $data['attr_spec_rule'] ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_check_attr_spec_rule_value_casei_data() {
		return array(
			'no_attributes' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'value_pass' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'value1',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_upper_pass' => array(
				array(
					'source' => '<div attribute1="VALUE1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'value1',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_fail' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'valuex',
					),
				),
				AMP_Rule_Spec::fail,
			),
			'value_no_attr' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'value1',
					),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'value_empty_pass1' => array(
				array(
					'source' => '<div attribute1=""></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => '',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_empty_pass2' => array(
				array(
					'source' => '<div attribute1></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => '',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_empty_fail' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => '',
					),
				),
				AMP_Rule_Spec::fail,
			),
			'value_alternative_attr_name_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'value1',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_alternative_attr_name__upper_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="VALUE1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'value1',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_alternative_attr_name_fail' => array(
				array(
					'source' => '<div attribute1_alternative1="value2"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'value_casei' => 'value1',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
		);
	}

	/**
	 * @dataProvider get_check_attr_spec_rule_value_casei_data
	 * @group allowed-tags-private-methods
	 */
	public function test_check_attr_spec_rule_value_casei( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );

		$got = $this->invoke_method( $sanitizer, 'check_attr_spec_rule_value_casei', array( $node, $data['attr_name'], $data['attr_spec_rule'] ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_check_attr_spec_rule_blacklisted_value_regex() {
		return array(
			'no_attributes' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'value_pass' => array(
				array(
					'source' => '<div attribute1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'blacklisted_value_regex' => '(not_this|or_this)',
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_fail' => array(
				array(
					'source' => '<div attribute1="not_this"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'blacklisted_value_regex' => '(not_this|or_this)',
					),
				),
				AMP_Rule_Spec::fail,
			),
			'value_no_attr' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'blacklisted_value_regex' => '(not_this|or_this)',
					),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'value_alternative_attr_name_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="value1"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'blacklisted_value_regex' => '(not_this|or_this)',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'value_alternative_attr_name_fail' => array(
				array(
					'source' => '<div attribute1_alternative1="not_this"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'blacklisted_value_regex' => '(not_this|or_this)',
						'alternative_names' => array(
							'attribute1_alternative1',
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
		);
	}

	/**
	 * @dataProvider get_check_attr_spec_rule_blacklisted_value_regex
	 * @group allowed-tags-private-methods
	 */
	public function test_check_attr_spec_rule_blacklisted_value_regex( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );

		$got = $this->invoke_method( $sanitizer, 'check_attr_spec_rule_blacklisted_value_regex', array( $node, $data['attr_name'], $data['attr_spec_rule'] ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_check_attr_spec_rule_allowed_protocol() {
		return array(
			'no_attributes' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'protocol_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allowed_protocol' => array(
							'http',
							'https',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'protocol_multiple_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com, https://domain.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allowed_protocol' => array(
							'http',
							'https',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'protocol_fail' => array(
				array(
					'source' => '<div attribute1="data://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allowed_protocol' => array(
							'http',
							'https',
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
			'protocol_multiple_fail' => array(
				array(
					'source' => '<div attribute1="http://example.com, data://domain.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allowed_protocol' => array(
							'http',
							'https',
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
			'protocol_alternative_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="http://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'alternative_names' => array(
							'attribute1_alternative1',
						),
						'allowed_protocol' => array(
							'http',
							'https',
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'protocol_alternative_fail' => array(
				array(
					'source' => '<div attribute1_alternative1="data://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'alternative_names' => array(
							'attribute1_alternative1',
						),
						'allowed_protocol' => array(
							'http',
							'https',
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
		);
	}

	/**
	 * @dataProvider get_check_attr_spec_rule_allowed_protocol
	 * @group allowed-tags-private-methods
	 */
	public function test_check_attr_spec_rule_allowed_protocol( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );

		$got = $this->invoke_method( $sanitizer, 'check_attr_spec_rule_allowed_protocol', array( $node, $data['attr_name'], $data['attr_spec_rule'] ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	public function get_check_attr_spec_rule_disallowed_relative() {
		return array(
			'no_attributes' => array(
				array(
					'source' => '<div></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(),
				),
				AMP_Rule_Spec::not_applicable,
			),
			'disallowed_relative_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
					),
				),
				AMP_Rule_Spec::pass,
			),
			'disallowed_relative_ multiple_pass' => array(
				array(
					'source' => '<div attribute1="http://example.com, http://domain.com/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
					),
				),
				AMP_Rule_Spec::pass,
			),
			'disallowed_relative_alternative_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="http://example.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
						'alternative_names' => array(
							'attribute1_alternative1'
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'disallowed_relative_alternative_multiple_pass' => array(
				array(
					'source' => '<div attribute1_alternative1="http://example.com, http://domain.com"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
						'alternative_names' => array(
							'attribute1_alternative1'
						),
					),
				),
				AMP_Rule_Spec::pass,
			),
			'disallowed_relative_fail' => array(
				array(
					'source' => '<div attribute1="/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
					),
				),
				AMP_Rule_Spec::fail,
			),
			'disallowed_relative_multiple_fail' => array(
				array(
					'source' => '<div attribute1="//domain.com, /relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
					),
				),
				AMP_Rule_Spec::fail,
			),
			'disallowed_relative_alternative_fail' => array(
				array(
					'source' => '<div attribute1_alternative1="/relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
						'alternative_names' => array(
							'attribute1_alternative1'
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
			'disallowed_relative_alternative_multiple_fail' => array(
				array(
					'source' => '<div attribute1_alternative1="http://domain.com,  /relative/path/to/resource"></div>',
					'node_tag_name' => 'div',
					'attr_name' => 'attribute1',
					'attr_spec_rule' => array(
						'allow_relative' => false,
						'alternative_names' => array(
							'attribute1_alternative1'
						),
					),
				),
				AMP_Rule_Spec::fail,
			),
		);
	}

	/**
	 * @dataProvider get_check_attr_spec_rule_disallowed_relative
	 * @group allowed-tags-private-methods
	 */
	public function test_check_attr_spec_rule_disallowed_relative( $data, $expected ) {
		$dom = AMP_DOM_Utils::get_dom_from_content( $data['source'] );
		$node = $dom->getElementsByTagName( $data['node_tag_name'] )->item( 0 );
		$sanitizer = new AMP_Tag_And_Attribute_Sanitizer( $dom );

		$got = $this->invoke_method( $sanitizer, 'check_attr_spec_rule_disallowed_relative', array( $node, $data['attr_name'], $data['attr_spec_rule'] ) );

		if ( $expected != $got ) {
			printf( 'using source: %s' . PHP_EOL, $data['source'] );
			var_dump( $data );
		}

		$this->assertEquals( $expected, $got );
	}

	// Use this to call private methods
	public function invoke_method(&$object, $methodName, array $parameters = array()) {
	    $reflection = new \ReflectionClass(get_class($object));
	    $method = $reflection->getMethod($methodName);
	    $method->setAccessible(true);

	    return $method->invokeArgs($object, $parameters);
	}

}

?>