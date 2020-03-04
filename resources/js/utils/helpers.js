    export function scrollToTop() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
    export function pushTab(baseURL, tab) {
        let joinedUrl = `${baseURL + tab}`;
        history.pushState("", "", joinedUrl);
    }
