function loadCSS(filename){
    console.log('load css');
    var file = document.createElement("link");
    file.setAttribute("rel", "stylesheet");
    file.setAttribute("type", "text/css");
    file.setAttribute("href", filename);
    console.log(file);
    document.head.appendChild(file);
}