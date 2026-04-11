function isInArray(value, array) {
	return array instanceof Array && array.indexOf(value) > -1;
}



function multicheckbox($, idp, names, values, initialvalues, callback, params, options) {
	this._idp = idp;
	this._values = values;
	this._names = names;
	this._initialvalues = initialvalues;
	this._callback = callback;
	this._params = params;
	this._options = options ?? { "checked": "btn-success", "unchecked" : "btn-warning"};
	this.callback = function()
	{
		var listselected = [];
		$(this._idp).find("[class='multicheckbox']").each(function() {
				if ($(this).prop('checked')){
					listselected.push($(this).attr('for'));
				}
		});
		this._callback($, listselected, this._params);
	}
	this.changecheckbox = function(chkbox) {
		var checked = $(chkbox).prop('checked');
		var label = $('label[for="'+$(chkbox).attr('id')+'"]');
		var checkedclass = (checked)?this._options["checked"]:this._options["unchecked"];
		var btclass = "btn btn-sm " + checkedclass;
		label.attr('class', btclass);
	};
	this.check = function(value, checked) {
		$(this._idp).find('[class="multicheckbox"]').each(function() {
			if ($(this).attr("for") == value) {
				$(this).prop('checked', checked);
                $(this).change();
			}
		});
	};	
	this.checkall = function(checked) {
		$(this._idp).find("[class='multicheckbox']").each(function() {
				$(this).prop('checked', checked);
                $(this).change();    
			}	
		);
		this.callback();
	}
	this.init = function() {
		$(this._idp).html('');
		var text = '<table class="multicheckbox" style="table-layout: auto;">\n\t<tr>';
		var that = this;
		$.each(this._values,function(index, value) {
			var checked = isInArray(value, that._initialvalues)? 1:0;
			var checkedclass = ((checked)?that._options["checked"]:that._options["unchecked"]);
			var btclass = "btn btn-sm " + checkedclass;
			var checkedattr = (checked)?"checked":"";
			var id = "checked_" + value;
			text = text + "<td>"+
							"<input style=\"float:left;font-size:50%;\" class=\"multicheckbox\" type=\"checkbox\" " +  checkedattr +" id=\"" + id  +
									"\" value=\""+index + "\" "
									+ " for=\"" + value + "\""
									+ " idp=\"" + that._idp + "\""
									+ checkedattr + " >"
							+ "<label class=\"" + btclass +"\" for=\"" +  id +"\" >" 
									+ that._names[index]
							+ "</label>";
			text = text +'</td>';
			if ((index+1 % 6) == 0)
				text = text + '</tr><tr>';
		});
		text += "</tr>\n</table>";
		$(this._idp).html(text);
		$("input[class='multicheckbox']").data('multicheckbox', this);
		$("input[class='multicheckbox']").change(function() {
											var multicheckbox = $(this).data('multicheckbox');
											multicheckbox.changecheckbox(this);
											multicheckbox.callback();
										});
		$("input[class='multicheckbox']").each(function() {
			$(this).data('multicheckbox').changecheckbox(this);
		});
	};
	this.init();
	return this;
}

function initmulticheckbox($, idp, names, values, initialvalues, callback, params, options = null) {
	$(idp).show();
	multicheck = new multicheckbox($, idp, names, values, initialvalues, callback, params, options);
	$(idp).data('multicheckbox', multicheck);
	return multicheck;
}

function initmulticheckboxjson($, idp, jsonarray, callback, params, options = null) {
    var values = [];
    var names = [];
    $.each(jsonarray, function(index, value) { 
            values.push(value.value); 
            names.push(value.name);
        }
    );    
    var multicheck = new multicheckbox($, idp, names, values, [], callback, params, options);
	$(idp).data('multicheckbox', multicheck);
    return multicheck;
}
