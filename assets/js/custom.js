
$(document).ready(function() {
	// DATATABLE 
	var datatable = $('.datatable').DataTable({
		'dom' : 'lrftip',
		'language': {
			'searchPlaceholder': "Ketik..."
		},
		'aLengthMenu': [[5,10,50,100,1000], [5,10,50,100,1000]],
		'searching':!0,
		'lengthChange':!0,
		'order':[],
		'ordering':!0,
		'columnDefs': [
		{'orderable':!1,'targets':"no-sort"}
		]
	});

	// DATATABLE CHEKCK BOX
	var datatablecheckbox = $('.datatablecheckbox').DataTable({
		'dom' : 'lrftip',
		'language': {
			'searchPlaceholder': "Ketik..."
		},
		'aLengthMenu': [[5,10,50,100,1000], [5,10,50,100,1000]],
		'searching':!0,
		'lengthChange':!0,
		'order':[],
		'ordering':!0,
		'columnDefs': [
		{'orderable':!1,'targets':"no-sort"},
		{'targets': 0,'checkboxes': {'selectRow': true}}
		],
		'select': {
			'style': 'multi'
		},
	});

	// CLASS ACTIVE
	var current = location.search.substr(1) ? location.search.substr(1) : './';
	var status = "ok";
	$('.c-sidebar__list .c-sidebar__item .c-sidebar__link').each(function(){
		var $this = $(this);
		if($this.attr('href').indexOf(current) !== -1){
			$this.addClass('is-active');
			status = "add";
		}
	});
	if(status == "ok"){
		$('.dashboard').addClass('is-active');
	}  

	// JOIN GROUP SEARCH
	$("input[name='query']").keydown(function(event){
		if(event.keyCode == 13) {
			var query = $("input[name='query']").val();
			if (query == '') {
				$("input[name='query']").focus();
				return false;
			}else {			
				location.href = '?module=joingroup&q=' + query;
			}
			event.preventDefault();
		}
	});
	$('.getquery').on("click",function(){
		var query = $("input[name='query']").val();
		if (query == '') {
			$("input[name='query']").focus();
		}else {			
			location.href = '?module=joingroup&q=' + query;
		}
	})

	// DELETE POST GROUP
	$("input[name='maxwhile']").keydown(function(event){
		if(event.keyCode == 13) {
			var maxwhile = $("input[name='maxwhile']").val();
			if (maxwhile == '') {
				$("input[name='maxwhile']").focus();
				return false;
			}else {			
				location.href = $(".maxwhile").data('url') + maxwhile;
			}
			event.preventDefault();
		}
	});
	$('.maxwhile').on("click",function(){
		var maxwhile = $("input[name='maxwhile']").val();
		if (maxwhile == '') {
			$("input[name='maxwhile']").focus();
		}else {			
			location.href = $(".maxwhile").data('url') + maxwhile;
		}
	})

	// BOT POST GROUP
	$('#setting_time').on("change", function(e) { 
		$("#setting_jam,#setting_hari,#setting_minggu").hide();
		var data = $(".c-select option:selected").val();
		$("#" + data).show();
	});

	// DATATABLE SEARCH MOVE
	$('div.dataTables_filter').appendTo($('.c-table__title'));
	$('div.dataTables_length').css({'width':'50%','float':'left'});
	$('div.dataTables_length').appendTo($('.c-table__title'));
	$('div.dataTables_filter').css({'width':'50%','float':'right','text-align':'right'});

	// AJAX BRAY
	$('.formtablecheckbox').on('submit', function(e){
		e.preventDefault();
		var btn = $("input[type='submit']");
		var hidden = $("input[type='hidden']");
		var progressbar = $('.c-progress');
		hidden.remove();

		var form=this,rows_selected=datatablecheckbox.column(0).checkboxes.selected();$.each(rows_selected,function(e,t){
			$(form).append($("<input>").attr("type","hidden").attr("name","target[]").val(t))
		});

		btn.prop('disabled',true);
		btn.val('On Progress...');

		var lastResponseLength = false;
		$.ajax({
			type: 'post',
			url : btn.data("post"),
			data : $(".formtablecheckbox").serialize(),
			dataType: 'json',
			processData: false,
			xhrFields: {
				onprogress: function(e)
				{
					progressbar.fadeIn();
					var response = event.currentTarget.response;
					if(lastResponseLength == false && response.length == 1)
					{
						progressResponse = response;
						lastResponseLength = response.length;
					}
					else
					{
						progressResponse = response.substring(lastResponseLength);
						lastResponseLength = response.length;
					}
					var parsedResponse = JSON.parse(progressResponse);
					if (parsedResponse.message == 'error') {
						$('#fullResponse').text(parsedResponse.message);
						sweetAlert('Ehmm', parsedResponse.code , 'error');
						btn.prop('disabled',false);
						btn.val('Submit');
					}else if (parsedResponse.message == 'Complete') {
						$('#fullResponse').text(parsedResponse.message);
						if (parsedResponse.redirect) {							
							sweetAlert('Berhasil Memproses Permintaan!', 'Sukses : ' + parsedResponse.success + ' | Gagal : ' + parsedResponse.error , 'success').then(function()  {window.location = parsedResponse.redirect; });
						}else{
							sweetAlert('Berhasil Memproses Permintaan!', 'Sukses : ' + parsedResponse.success + ' | Gagal : ' + parsedResponse.error , 'success');							
							btn.prop('disabled',false);
							btn.val('Submit');
							progressbar.fadeOut();
						}
					}else{							
						$('#fullResponse').text(parsedResponse.message);
					}
					$('.c-progress__bar').css('width', parsedResponse.progress + '%');
				}
			}
		});

	})

	// AJAX SINGLE
	$('.formsingle').on('submit', function(e){
		e.preventDefault();
		var btn = $("input[type='submit']");
		var hidden = $("input[type='hidden']");
		var progressbar = $('.c-progress');

		btn.prop('disabled',true);
		btn.val('On Progress...');

		var lastResponseLength = false;
		$.ajax({
			type: 'post',
			url : btn.data("post"),
			data : $(".formsingle").serialize(),
			dataType: 'json',
			processData: false,
			xhrFields: {
				onprogress: function(e)
				{
					progressbar.fadeIn();
					var response = event.currentTarget.response;
					if(lastResponseLength == false && response.length == 1)
					{
						progressResponse = response;
						lastResponseLength = response.length;
					}
					else
					{
						progressResponse = response.substring(lastResponseLength);
						lastResponseLength = response.length;
					}
					var parsedResponse = JSON.parse(progressResponse);
					if (parsedResponse.message == 'error') {
						$('#fullResponse').text(parsedResponse.message);
						sweetAlert('Ehmm', parsedResponse.code , 'error');
						btn.prop('disabled',false);
						btn.val('Submit');
					}else if (parsedResponse.message == 'Complete') {
						$('#fullResponse').text(parsedResponse.message);
						sweetAlert('Berhasil Memproses Permintaan!', 'Sukses : ' + parsedResponse.success + ' | Gagal : ' + parsedResponse.error , 'success');							
						btn.prop('disabled',false);
						btn.val('Submit');
						progressbar.fadeOut();
					}else{							
						$('#fullResponse').text(parsedResponse.message);
					}
					$('.c-progress__bar').css('width', parsedResponse.progress + '%');
				}
			}
		});

	})

	// BOT POST GROUP
	$('.formbotpostgroup').on('submit', function(e){
		var form=this,rows_selected=datatablecheckbox.column(0).checkboxes.selected();$.each(rows_selected,function(e,t){
			$(form).append($("<input>").attr("type","hidden").attr("name","target[]").val(t))
		});
	})

});