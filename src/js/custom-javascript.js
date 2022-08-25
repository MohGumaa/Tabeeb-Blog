(function ($) {
	const ScrWindow = $(window);
	const bodyPage = $("body");
	const breadcrumbLast = $(".single-post .breadcrumb_last");
	const searchBtn = $("#search-btn");
	const searchForm = $("#search-from");
	const menuToggler = $(".menu__toggler");
	const searchResult = $(".live-search-result");
	const sourceLinkHeader = $(".source-links");
	const listSourceItem = sourceLinkHeader.next();
	const numberSource = listSourceItem.find("li").length;

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
		bodyPage.toggleClass("overflow-hidden");
	});

	// Remove Icon on Breadcrumb before last
	breadcrumbLast.prev().css("display", "none");

	// Like & Dislike Button
	$(".fa-thumbs-up").attr("class", "icon-thumbs-up");
	$(".fa-thumbs-down").attr("class", "icon-thumbs-down");

	// Show Link Source
	sourceLinkHeader.prepend(numberSource + " ");
	sourceLinkHeader.on("click", function () {
		$(this).toggleClass("minus");
		listSourceItem.slideToggle(500);
	});
})(jQuery);
