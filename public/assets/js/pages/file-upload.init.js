const handleChange = function () {
    var e = document.querySelector("#input-file").files;
    0 !== e.length && ((e = e[0]), readFile(e));
  },
  readFile = function (e) {
    if (e) {
      const n = new FileReader();
      (n.onload = function () {
        document.querySelector(
          ".preview-box"
        ).innerHTML = `<img class="preview-content" src=${n.result} />`;
      }),
        n.readAsDataURL(e);
    }
  };
var uppy = new Uppy.Uppy()
  .use(Uppy.Dashboard, { inline: !0, target: "#drag-drop-area" })
  .use(Uppy.Tus, { endpoint: "https://tusd.tusdemo.net/files/" });
uppy.on("complete", (e) => {});
