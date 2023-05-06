for (let tab of document.querySelectorAll(".tabs")) {
    let links = tab.querySelectorAll(".tabs__header-link"),
        sections = tab.querySelectorAll(".tabs__content-block");
    if (links.length != sections.length) {
        console.error("Number of tabs do not match!");
        continue;
    }

    for (let i=0; i<links.length; i++) {
        links[i].onclick = () => {
            for (let j=0; j<links.length; j++) {
                if (i==j) {
                    links[j].classList.add("tabs__header-link_active");
                    sections[j].classList.add("tabs__content-block_active");
                } else {
                    links[j].classList.remove("tabs__header-link_active");
                    sections[j].classList.remove("tabs__content-block_active");
                }
            }
        };
    }

    if (tab.querySelector(".tabs__header-link_active") == null) {
        links[0].classList.add("tabs__header-link_active");
        sections[0].classList.add("tabs__content-block_active");
    }
}
