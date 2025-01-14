YAHOO.example.DDList = function(id, sGroup, config) {

    if (id) {
        this.init(id, sGroup, config);
        this.initFrame();
        this.logger = this.logger || YAHOO;
    }

    var s = this.getDragEl().style;
    //s.borderColor = "transparent";
    //s.backgroundColor = "#f6f5e5";
    //s.opacity = 0.76;
    //s.filter = "alpha(opacity=76)";
};

YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy);

YAHOO.example.DDList.prototype.startDrag = function(x, y) {
    var dragEl = this.getDragEl();
    var clickEl = this.getEl();

    dragEl.innerHTML = clickEl.innerHTML;
    dragEl.className = clickEl.className;
    dragEl.style.color = clickEl.style.color;
    dragEl.style.border = "1px dotted #ccc";

};

YAHOO.example.DDList.prototype.endDrag = function(e) {
    // disable moving the linked element
};

YAHOO.example.DDList.prototype.onDrag = function(e, id) {
    
};

YAHOO.example.DDList.prototype.onDragOver = function(e, id) {
    var el;
    
    if ("string" == typeof id) {
        el = YAHOO.util.DDM.getElement(id);
    } else { 
        el = YAHOO.util.DDM.getBestMatch(id).getEl();
    }
    

    var mid = YAHOO.util.DDM.getPosY(el) + ( Math.floor(el.offsetTop / 2));

    if (YAHOO.util.Event.getPageY(e) < mid) {
        var el2 = this.getEl();
         if(el.id && hasElementClass(el, 'empty') && el.id.search('start') == 0) {
             return;
         }

        var p = el.parentNode;
        if(p.id != 'dashboard-container-left' && p.id != 'dashboard-container-right') {
            return;
        }
        p.insertBefore(el2, el);
    }
        
};

YAHOO.example.DDList.prototype.toString = function() {
    return "DDList " + this.id;
};


YAHOO.example.DDListBoundary = function(id, sGroup, config) {
    if (id) {
        this.init(id, sGroup, config);
        this.logger = this.logger || YAHOO;
        this.isBoundary = true;
    }
};

YAHOO.extend(YAHOO.example.DDListBoundary, YAHOO.util.DDTarget);

YAHOO.example.DDListBoundary.prototype.toString = function() {
    return "DDListBoundary " + this.id;
};

