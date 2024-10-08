
/* alternar menu mobile */
function toggleMenuMobile() {
    document.getElementById('sidebar').classList.toggle('show')
}
document.getElementById('toggle-sidebar').onclick = () => {
    toggleMenuMobile()
}
