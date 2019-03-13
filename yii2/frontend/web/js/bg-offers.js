$(function(){
	if( $('body').hasClass('show__bgoffer') )
	{
		var count_offers = $("#bgoffers .bgoffer").length;

		if (count_offers === 1) {
			$('#bgoffers .bgoffer').show();
		}

		if (count_offers > 1)
		{
			var time_show_offer_1 = 300;
			
			var start_time = Number($('#bgoffers').data('date'));
			var current_time = Date.now()/1000;
			var time = current_time - start_time;
			var multipler = Math.floor(time / time_show_offer_1);
			var offer_show_key = Math.floor(multipler % count_offers);
			
			show_bfoffer(offer_show_key);
		}
		
		function show_bfoffer(offer_show_key){
			$('#bgoffers .bgoffer').each(function (index, value) {
				if (index === offer_show_key) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		}
	};
});