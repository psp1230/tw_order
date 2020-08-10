
function exportTo(type) {

	$('.table').tableExport({
		filename: 'table_%DD%-%MM%-%YY%',
		format: type,
		cols: '2,3,4,5,6,7'
	});

}

function exportAll(type) {

	$('.table').tableExport({
		filename: 'table_%DD%-%MM%-%YY%-month(%MM%)',
		format: type
	});

}