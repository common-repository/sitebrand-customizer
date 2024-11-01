class Loader {
  loaderEl = document.querySelector(".sbc-loader");
  hide() {
    if (typeof this.loaderEl != "undefined")
      this.loaderEl.className += " disable";
  }
  show() {
    if (typeof this.loaderEl != "undefined")
      this.loaderEl.className = this.loaderEl.className.replace("disable", "");
  }
}

let loader: Loader;

document.addEventListener("DOMContentLoaded", function(event) {
  loader = new Loader();
  loader.hide();
});
window.onbeforeunload = function() {
  loader.show();
};
