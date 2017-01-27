$(document).ready(function () {
	$("#BtnBuscarAvanzada").click(function () {
		$(".search-form").toggle();
	});
});

$(document).ready(function () {
	$("#BtnBuscar").click(function () {
		$(".search-form").toggle();
	});
});

$(document).ready(function () {
	$("#BtnCerrar").click(function () {
		$(".search-form").toggle();
	});
});

function valueChanged() {
	$('.uso_normal').is(":checkbox")
	$(".uso_interno").toggle();
	$('.uso_normal').hide();
}