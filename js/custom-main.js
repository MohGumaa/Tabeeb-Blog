document.addEventListener("DOMContentLoaded", () => {
	const menuRightElem = document.getElementById("primary-menu");
	const searchResult = document.querySelectorAll(".live-search-result");
	const trustLinks = document.querySelectorAll("strong > a");

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

	// AR & EN Logo based on Location
	fetch("https://app.jubnaadserve.com/api/ipinfo")
		.then((response) => response.json())
		.then((jsonResponse) => {
			const country = jsonResponse.country_name;
			const logoImg = document.querySelector(".navbar-brand img");
			const logoFooter = document.querySelector(".footer-logo");

			if (
				country == "Saudi Arabia" ||
				country === "Syria" ||
				country === "United Arab Emirates" ||
				country === "Bahrain" ||
				country === "Algeria" ||
				country === "Egypt" ||
				country === "Iraq" ||
				country === "Jordan" ||
				country === "Kuwait" ||
				country === "Libya" ||
				country === "Lebanon" ||
				country === "Morocco" ||
				country === "Mauritania" ||
				country === "Oman" ||
				country === "Palestinian Territories" ||
				country === "Qatar" ||
				country === "Somalia" ||
				country === "Sudan" ||
				country === "Yemen" ||
				country === "Tunisia"
			) {
				console.log("same");
			} else {
				logoImg.src =
					"https://tabeeb.com/wp-content/uploads/2022/09/Logo-white-en.svg";
				logoFooter.src =
					"https://tabeeb.com/wp-content/uploads/2022/09/Logo-grey-en.svg";
			}
		})
		.catch((err) => {
			document.querySelector(".navbar-brand img").src =
				"https://tabeeb.com/wp-content/uploads/2022/06/tabeeb-logo-new.svg";
		});
});
