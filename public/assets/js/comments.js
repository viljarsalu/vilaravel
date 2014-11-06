// comments
$('#comments').on('shown.bs.collapse', function (e) {
	$('[data-target="#'+e.currentTarget.id+'"]').find('span').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    //console.log('test', e.currentTarget.id, $('[data-target="#'+e.currentTarget.id+'"]'));
});
$('#comments').on('hidden.bs.collapse', function (e) {
	$('[data-target="#'+e.currentTarget.id+'"]').find('span').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    //console.log('test', e.currentTarget.id, $('[data-target="#'+e.currentTarget.id+'"]'));
});



// comments form
$('#comment_form').on('show.bs.collapse', function (e) {
	$('[data-target="#'+e.currentTarget.id+'"]').not(':button').hide();
});
$('#comment_form').on('hide.bs.collapse', function (e) {
	$('[data-target="#'+e.currentTarget.id+'"]').not(':button').show();
});