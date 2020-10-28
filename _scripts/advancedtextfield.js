var proto = Object.create(HTMLDivElement.prototype);
proto.createdCallback = function () {
    var div = document.createElement("div");
    div.setAttribute("contenteditable","true");
    div.setAttribute("id",this.id+"Content");
    div.setAttribute("name",this.id+"Content");
    div.style.minWidth = "300px";
    div.style.minHeight =  "70px";
    div.style.maxWidth = "950px";
    div.style.border = "0px solid";
    div.style.padding = "5px";
    div.style.overflow = "auto";
    div.style.resize = "both";
    div.style.backgroundColor = "white";
    this.appendChild(div);
}
var advancedtextfield = document.registerElement('advanced-textfield', {
    prototype: proto
});