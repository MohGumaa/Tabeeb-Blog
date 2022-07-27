document.addEventListener("DOMContentLoaded", () => {
	const menuRightElem = document.getElementById("primary-menu");
	const searchResult = document.querySelectorAll(".live-search-result");

	const allEvents = [
		"sm.back",
		"sm.back-after",
		"sm.close",
		"sm.close-after",
		"sm.forward",
		"sm.forward-after",
		"sm.navigate",
		"sm.navigate-after",
		"sm.open",
		"sm.open-after",
	];

	const menuRight = new SlideMenu(menuRightElem, {
		keyClose: "Escape",
		submenuLinkAfter: '<span class="icon-chevron-left"></span>',
		backLinkAfter: '<span class="icon-chevron-right"></span>',
	});

	// Show & Hide Header
	(function () {
		const doc = document.documentElement;
		const w = window;

		let curScroll;
		let prevScroll = w.scrollY || doc.scrollTop;
		let curDirection = 0;
		let prevDirection = 0;

		let lastY = 0;

		const header = document.getElementById("wrapper-navbar");
		let toggled;
		let downThreshold = 400;
		let upThreshold = 200;

		const checkScroll = function () {
			curScroll = w.scrollY || doc.scrollTop;
			if (curScroll > prevScroll) {
				// scrolled down
				curDirection = 2;
			} else {
				//scrolled up
				curDirection = 1;
			}

			if (curDirection !== prevDirection) {
				toggled = toggleHeader();
			} else {
				lastY = curScroll;
			}

			prevScroll = curScroll;
			if (toggled) {
				prevDirection = curDirection;
			}
		};

		const toggleHeader = function () {
			toggled = true;
			if (curDirection === 2 && curScroll - lastY > downThreshold) {
				lastY = curScroll;
				header.classList.add("hide");

				searchResult.forEach((item) => {
					item.innerHTML = "";
				});
			} else if (curDirection === 1 && lastY - curScroll > upThreshold) {
				lastY = curScroll;
				header.classList.remove("hide");
			} else {
				toggled = false;
			}
			return toggled;
		};

		window.addEventListener("scroll", checkScroll);
	})();
});
