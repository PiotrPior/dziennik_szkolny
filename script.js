let size = 16;
function zwieksz() {
    size += 2;
    document.body.style.fontSize = size + "px";
}
function zmniejsz() {
    size -= 2;
    document.body.style.fontSize = size + "px";
}
function darkMode() {
    document.body.classList.toggle("dark");
}
tinymce.init({
  selector: '#editor'
});