(function($) {

	if(!$) {
		return;
	}

	////////////
	// Plugin //
	////////////

	$.fn.datepair = function(option) {
		var out;
		this.each(function() {
			var $this = $(this);
			var data = $this.data('datepair');
			var options = typeof option === 'object' && option;

			if (!data) {
				data = new Datepair(this, options);
				$this.data('datepair', data);
			}

			if (typeof option === 'string') {
				out = data[option]();
			}
		});

		return out || this;
	};

	//////////////
	// Data API //
	//////////////

	$('[data-datepair]').each(function() {
		var $this = $(this);
		$this.datepair($this.data());
	});

}(window.Zepto || window.jQuery));

function initdatepair($, classname) {
	var MOMENTDATEFORMAT = 'YYYY-MM-DD' ;
	var MOMENTTIMEFORMAT = 'HH:mm:ss' ;
		console.log('timepair setting:' + classname + ":");
		$(document).ready(function() {
			console.log($("." + classname));
			$("." + classname).datepair({'dateClass': 'date', 'startClass': 'start', 'endClass': 'end', 'setMinTime': null,
				parseTime: function(input){
					// use moment.js to parse time
					var m = moment(input.value, MOMENTTIMEFORMAT);
					return m.toDate();
				},
				updateTime: function(input, dateObj){
					var m = moment(dateObj);
					input.value = m.format(MOMENTTIMEFORMAT);
				},
				parseDate: function(input){
					console.log('parste date');
					var m = moment(input.value, MOMENTDATEFORMAT);
					return m.toDate();
				},
				updateDate: function(input, dateObj){
					var m = moment(dateObj);
					input.value = m.format(MOMENTDATEFORMAT);
					input.innerHTML = input.value;
					jQuery(input).trigger('change');
				},
				setMinTime: null
			 });
		});
}
