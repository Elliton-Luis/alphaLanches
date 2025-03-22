function redirectTo(button) {
    let route = button.getAttribute("data-route");
    window.location.href = route;
}