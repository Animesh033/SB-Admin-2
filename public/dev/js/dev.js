var uiController = (function() {
var DOMstrings = {
    addBtn: '.add',
    removeBtn: '.remove',
    removeBtnId: 'remove',
    submitBtn: '#create-quotation',
    rowCount: 1
};
return {
    getDomStrings: function() {
        return DOMstrings;
    }
};

})();

var controller = (function(uiCtrl) {
var DOM = uiCtrl.getDomStrings();
var setupEventListeners = function() {
    document.querySelector(DOM.addBtn).addEventListener('click', ctrlAddItem);
    document.addEventListener('keypress', function(event) {
        if (event.keyCode === 13 || event.which === 13) {
            ctrlAddItem();
        }
    });
};

var ctrlAddItem = function() {
    var itemId = DOM.removeBtnId+'-'+DOM.rowCount++;
    $('<div class="mt-2" id="'+itemId+'"><div class="form-row"><div class="col-2"> <select class="form-control" id="category" name="category[]"><option value="">-Select Category-</option> @foreach ($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option> @endforeach </select></div><div class="col-1"> <input type="text" name="width[]" class="form-control" placeholder="Width"></div><div class="col-1"> <input type="text" name="height[]" class="form-control" placeholder="Height"></div><div class="col-1"> <input type="text" name="shutter[]" class="form-control" placeholder="Shutter"></div><div class="col-1"> <input type="text" name="net[]" class="form-control" placeholder="Net"></div><div class="col-2"> <input type="text" name="sq_feet[]" class="form-control" placeholder="Sq. Feet"></div><div class="col-2"> <input type="text" name="rate[]" class="form-control" placeholder="Rate"></div><div class="col-2 m-0 p-2" id="_'+itemId+'"> <i class="fas fa-minus-circle"></i></div></div></div>').insertBefore($(DOM.submitBtn));
    document.querySelector('#_'+itemId).addEventListener('click', () => {
        ctrlDeleteItem(itemId);
    }, false);
};

var ctrlDeleteItem = (removeItemId) => {
    $('#'+removeItemId).remove();
    DOM.rowCount--;
}
return {
    init: function() {
        console.log('Application has started.');
        setupEventListeners();
    }
};
})(uiController);
controller.init();
