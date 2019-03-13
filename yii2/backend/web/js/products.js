$(function(){

	var sections_furnitura = ['14','15'];
	
	if ($('#manufacturers-mnf_id').val() && sections_furnitura.indexOf($('#manufacturers-mnf_section').val()) !== -1) {
		$('.cattree-inputs input[type="checkbox"]').on('click', function(event) {
			
			if ($(this).parent('label').parent('li').hasClass('has-child')) {
				alert('Выбирать можно только подкатегорию товара');
				return false;
			} else if (!$(this).is(':checked')){
				alert('Должна быть выбрана категория');
				return false;
			}

			var cur_chbx = this.value;
			var parent_tag = $(this).parents('li.has-child');
			var parent_chbx = parent_tag.children('label').children('input[type="checkbox"]');

			if (this.value > 0 && $(this).prop('checked') && !$(this).parent('label').parent('li').hasClass('has-child')) {
				parent_chbx.prop('checked', true);

				$('.cattree-inputs input[type="checkbox"]').each(function() {//очистка всех чекбоксов
					if (cur_chbx !== this.value) {
						var curent_parent_tag = $(this).parent('label').parent('li.has-child');
						if (typeof(curent_parent_tag.attr('id')) === 'undefined' || curent_parent_tag.attr('id') !== parent_tag.attr('id')) {
							$(this).attr('checked', false);
						}
					}
				});

				if ($('#products-prod_id').val()) {
					var url = '/products/' + $('#products-prod_id').val() + '?manufacture=' + $('#manufacturers-mnf_id').val();
				} else {
					var url = '/products/add?manufacture=' + $('#manufacturers-mnf_id').val();
				}

				console.log($(this).val());
					$.pjax.reload({
							container: '#category-value-pjax',
							url: url,
							timeout: 0,
							data: {
								 'cat_id': $(this).val()
							},
					});
			}
		});

		$('.cattree-inputs input[type="checkbox"]').each(function() {
			var cat_id = $('#categories-cat_id') ? $('#categories-cat_id') : null;
			if (cat_id && cat_id == this.value) {
				$(this).attr('checked', true);
				var parent_cat_id = $(this).parents('li.has-child');
				parent_cat_id.children('label').children('input[type="checkbox"]').attr('checked', true);
			}
		});
	}
});
