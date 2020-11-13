jQuery(function ($) {
	"use strict";
	checkboxToggle();
	toggleDisplaysetting();
	 // togglePostFormatMetaBoxes();
	togglePostFormatMetaBoxes_gutenberg__editor();

	/**
	 * Show, hide a <div> based on a checkbox
	 *
	 * @return void
	 * @since 1.0
	 */
	function checkboxToggle() {
		$('body').on('change', '.checkbox-toggle input', function () {
			var $this = $(this),
				$toggle = $this.closest('.checkbox-toggle'),
				action;
			if (!$toggle.hasClass('reverse'))
				action = $this.is(':checked') ? 'slideDown' : 'slideUp';
			else
				action = $this.is(':checked') ? 'slideUp' : 'slideDown';

			$toggle.next()[action]();
		});
		$('.checkbox-toggle input').trigger('change');
	}

	/**
	 * Show, hide post format meta boxes
	 *
	 * @return void
	 * @since 1.0
	 */
	function togglePostFormatMetaBoxes() {
		var $input = $('input[name=post_format]'),
			$metaBoxes = $('[id^="meta-box-post-format-"]').hide();

		$input.change(function () {
			$metaBoxes.hide();
			$('#meta-box-post-format-' + $(this).val()).show();
		});
		$input.filter(':checked').trigger('change');
	}

	function toggleDisplaysetting() {
		jQuery('#page_template').change(function () {
			jQuery('#display-settings')[jQuery(this).val() == 'default' ? 'show' : 'hide']();
		}).trigger('change');
		jQuery('.post-type-attachment #display-settings').hide();
	}

	function togglePostFormatMetaBoxes_gutenberg__editor() {
		var $metaBoxes = jQuery('.postbox[id*="meta-box-post-format-"]');
		// console.log($metaBoxes);
		jQuery(document).on('change', 'select[id*="post-format"]', function () {
			$metaBoxes.hide();
			console.log($(this).val());
			jQuery('#meta-box-post-format-' + $(this).val()).show();
		}).trigger('change');
 	}
});