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

	// Trust Link
	trustLinks.forEach((link) => {
		const sourceLink = link.getAttribute("href");
		const url = new URL(sourceLink);
		const sourceDoamin = url.origin;
		const sourceName = url.hostname
			.replace(/^(?:https?:\/\/)?(?:www\.)?/i, "")
			.split("/")[0];
		const parentContainer = link.parentElement;

		// Create Icon For Link
		// const iconElement = document.createElement("i");
		// iconElement.className = "icon-check-circle";
		// link.appendChild(iconElement);

		const div = document.createElement("div");
		div.className = "hoverDetail";

		let output = `
            <div class="d-flex flex-column justify-content-between align-items-conter">
                <a href="${sourceDoamin}" target="_blank" class="d-flex align-items-center source-text-sm text-info"><i class='icon-check-circle text-info small ms-1'></i>مصدر موثوق</a> 
                <span class="text-dark fw-bold">المصدر : <span class="text-secondary fw-normal text-lowercase small">${sourceName}</span></span>
                <a href="${sourceLink}" target="_blank" class="text-info">التوجه إلى رابط المصدر</a> 
            </div> 
        `;

		div.innerHTML = output;

		parentContainer.appendChild(div);

		const screenHeight = window.innerHeight / 2;
		const screenWidth = window.innerWidth / 2;

		link.addEventListener("mouseover", () => {
			const parentContainer = link.parentElement;
			const topPos = link.getBoundingClientRect().top;
			const leftpost = link.getBoundingClientRect().left;

			if (topPos > 158) {
				div.classList.remove("top-pos");
				div.classList.add("bottom-pos");
			} else {
				div.classList.remove("bottom-pos");
				div.classList.add("top-pos");
			}

			if (leftpost < screenWidth) {
				div.classList.remove("right-pos");
				div.classList.add("left-pos");
			} else {
				div.classList.remove("left-pos");
				div.classList.add("right-pos");
			}
		});

		if (window.screen.width < 769) {
			link.classList.add("isDisabled");
			div.classList.add("d-none");

			parentContainer.dataset.bsToggle = "modal";

			parentContainer.dataset.bsTarget = "#sourceLink";

			parentContainer.addEventListener("click", function () {
				const modalBody = document.querySelector(".body-source");
				modalBody.innerHTML = output;
			});
		}
	});

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
