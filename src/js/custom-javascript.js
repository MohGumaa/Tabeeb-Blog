(function ($) {
	const ScrWindow = $(window);
	const bodyPage = $("body");
	const searchBtn = $("#search-btn");
	const searchForm = $("#search-from");
	const menuToggler = $(".menu__toggler");
	const searchResult = $(".live-search-result");

	searchBtn.on("click", function () {
		if (ScrWindow.width() > 991) {
			$("#search-from").toggleClass("active");
			$(this).toggleClass("active-open");
			$("a.mega-menu-link").toggleClass("light-fade");
			searchForm
				.find("input[type=search]")
				.focus()
				.val("")
				.css("cursor", "auto");
			searchResult.html("");
		}
	});

	// Toggler Button Menu
	menuToggler.on("click", function () {
		$(this).toggleClass("active");
		bodyPage.toggleClass("overflow-hidden");
	});

	$("#btn-mobile-menu").on("click", function () {
		menuToggler.toggleClass("active");
		// bodyPage.toggleClass("overflow-hidden").toggleClass("overlay");
		bodyPage.toggleClass("overflow-hidden");
	});
})(jQuery);
