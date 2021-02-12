<x-admin.layout>
    <x-slot name="title">Create Receipt</x-slot>
    <x-slot name="pageHeading">Create Receipt</x-slot>
    <div class="card card-radius-20 mb-5">
        <div class="card-body">
            <form id="receipt" method="POST" action="{{ route('receipts.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-2" id="select-cus-btn">
                        <div class="form-group">
                        <label for="customer">Select customer:</label>
                        <select class="form-control" id="customer" name="customer_id">
                            <option value="">-Select Customer-</option>
                            @if (isset($customers) && count($customers))
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Receipt Details:</label>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="description[]" class="form-control" placeholder="Description">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="hsn_code[]" class="form-control" placeholder="HSN Code">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="text" name="qty[]" class="form-control" placeholder="Qty">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="text" name="rate[]" class="form-control" placeholder="Rate">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" name="taxable_value[]" class="form-control" placeholder="Taxable value">
                        </div>
                    </div>
                    <div class="col-2 m-0 p-2">
                        <i class="fas fa-plus-circle add pointer"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2" id="create-receipt">Save</button>
            </form>
        </div>
    </div>
    @push('scripts')
    <script>
    $(function() {
        var uiController = (function() {
            var DOMstrings = {
                addBtn: '.add',
                removeBtn: '.remove',
                removeBtnId: 'remove',
                submitBtn: '#create-receipt',
                rowCount: 1,
                btn: '.btn',
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
                $('<div id="'+itemId+'"><div class="row"><div class="col-md-2"><div class="form-group"> <input type="text" name="description[]" class="form-control" placeholder="Description"></div></div><div class="col-md-2"><div class="form-group"> <input type="text" name="hsn_code[]" class="form-control" placeholder="HSN Code"></div></div><div class="col-md-1"><div class="form-group"> <input type="text" name="qty[]" class="form-control" placeholder="Qty"></div></div><div class="col-md-1"><div class="form-group"> <input type="text" name="rate[]" class="form-control" placeholder="Rate"></div></div><div class="col-md-2"><div class="form-group"> <input type="text" name="taxable_value[]" class="form-control" placeholder="Taxable value"></div></div><div class="col-2 m-0 p-2"> <i class="fas fa-minus-circle pointer" id="_'+itemId+'"></i></div></div></div>').insertBefore($(DOM.submitBtn));
                document.querySelector('#_'+itemId).addEventListener('click', () => {
                    ctrlDeleteItem(itemId);
                }, false);
            };

            var ctrlDeleteItem = (removeItemId) => {
                console.log(removeItemId)
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
        });
    </script>
    @endpush
</x-admin.layout>
