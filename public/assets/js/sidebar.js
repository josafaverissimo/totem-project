function activeCurrentNavLink() {
    function activeNavLink(navLink, subNavLink) {
        subNavLink = !!subNavLink ? subNavLink : "table"

        const navLinkNode = document.querySelector("#" + navLink + "-nav-link")
        const subNavLinkNode = document.querySelector("#" + navLink + "-nav-link-" + subNavLink)

        if(navLinkNode) navLinkNode.classList.add("active")
        if(subNavLinkNode) {
            subNavLinkNode.classList.add("active")

            navLinkNode.parentNode.classList.add("menu-is-opening", "menu-open")
        }
    }

    const navLinks = {
        dashboard: activeNavLink,
        user: activeNavLink,
        client: activeNavLink,
        event: activeNavLink,
        eventCategory: function(navLink, subNavLink) {
            navLink = "event-category"
            subNavLink = !!subNavLink ? subNavLink : "table"

            const eventNavLinkNode = document.querySelector("#event-nav-link")
            const eventCategoryNavLinkNode = document.querySelector("#" + navLink + "-nav-link")
            const subNavLinkNode = document.querySelector("#" + navLink + "-nav-link-" + subNavLink)

            
            eventNavLinkNode.parentNode.classList.add("menu-is-opening", "menu-open")
            eventNavLinkNode.classList.add("active")

            eventCategoryNavLinkNode.parentNode.classList.add("menu-is-opening", "menu-open")
            eventCategoryNavLinkNode.classList.add("active")

            subNavLinkNode.classList.add("active")            
        }
    }

    const currentNavLink = PAGE.split("/")[0]
    const subNavLink = PAGE.split("/")[1]

    navLinks[currentNavLink](currentNavLink, subNavLink)
}

document.addEventListener("DOMContentLoaded", function(event) {
    activeCurrentNavLink()
})