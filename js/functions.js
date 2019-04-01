(function($){

	$(".btn-edit").on("click", function(){

	var id = $(this).data("id");

		$('<input>').attr({
			type: 'hidden',
			name: 'id',
			value: id
		}).appendTo('#editar');


	$("#editar").submit();

	});

	$(".salvar").on("click", function(){

		$("#salvar").submit();

	});

	$(".novo").on("click", function(){

		$("#editar").submit();

	});

	$(".excluir").on("click", function(){

		$('<input>').attr({
			type: 'hidden',
			name: 'acao',
			value: 'excluir'
		}).appendTo('#navegacao');

		$("#navegacao").submit();

	});

	$(".cancelar").on("click", function(){

		$('<input>').attr({
			type: 'hidden',
			name: 'acao',
			value: 'listando'
		}).appendTo('#navegacao');

		$("#navegacao").submit();

	});
	
})(jQuery);
