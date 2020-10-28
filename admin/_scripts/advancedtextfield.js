var proto = Object.create(HTMLDivElement.prototype);
proto.createdCallback = function () {
    var div = document.createElement("div");
    div.setAttribute("contenteditable","true");
    div.setAttribute("id",this.id+"Content");
    div.setAttribute("name",this.id+"Content");
    div.style.minWidth = "120px";
    div.style.minHeight =  "40px";
    div.style.width = "100%";
    div.style.maxWidth = "950px";
    div.style.border = "1px solid gray";
    div.style.borderRadius = "5px";
    div.style.padding = "5px";
    div.style.overflow = "auto";
    div.style.resize = "both";
    div.style.backgroundColor = "white";
    this.appendChild(div);
}
var advancedtextfield = document.registerElement('advanced-textfield', {
    prototype: proto
});