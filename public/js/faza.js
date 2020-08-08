$('#datePicker').datepicker({
	format: "yyyy-mm-dd",
	orientation: "bottom auto",
	autoclose: true
});

function createPagination(page, totalRow){
	$('#message').removeClass('alert-danger').addClass('alert-success').text('Menampilkan halaman '+page+' dari total '+(Math.ceil(totalRow/10))+' halaman').show();
	$('#page-control .pagination').text('');
	if(page!==1){
		$('#page-control .pagination').append('<li><a id="page-'+(page-1)+'"><i class="fa fa-chevron-circle-left fa-fw"></i></a></li>');
	}
	totalPage = Math.ceil(totalRow/10);
	if(totalPage>=5){
		if(page<3){
			startPagination = 1;
			endPagination = 5;
		}else{
			if(page>totalPage-2){
				if(page===totalPage-1){
					startPagination = page-3;
					endPagination = page+1;
				}else{
					startPagination = page-4;
					endPagination = page;
				}
			}else{
				startPagination = page-2;
				endPagination = page+2;
			}
		}
	}else{
		startPagination = 1;
		endPagination = totalPage;
	}
	for(i=startPagination;i<=endPagination;i++){
		temp = '<li';
		id = '';
		if(i===page){
			temp = temp+' class="active"';
		}else{
			id = ' id="page-'+i+'"';
		}
		$('#page-control .pagination').append(temp+'><a'+id+'>'+i+'</a></li>');
	}
	if(page!==totalPage){
		$('#page-control .pagination').append('<li><a id="page-'+(page+1)+'"><i class="fa fa-chevron-circle-right fa-fw"></i></a></li>');
	}
}

function getPage(){
	page = null;
	url = window.location.href;
	if(url.match(/page\/\d+/)!==null){
		page = url.match(/page\/\d+/);
	}else if(url.match(/page\/\d+\//)!==null){
		page = url.match(/page\/\d+\//);
	}
	if(page!==null){
		page = parseInt(page[0].substr(5, page[0].length-5));
	}
	return page;
}

function getKeyword(){
	keyword = null;
	url = window.location.href;
	if(url.match(/keyword\=(.)+/)!==null){
		keyword = url.match(/keyword\=(.)+/);
		keyword = keyword[0].substr(8, keyword[0].length-8);
	}
	return keyword;
}

function urldecode(str){
	return decodeURIComponent((str+'').replace(/\+/g, '%20'));
}