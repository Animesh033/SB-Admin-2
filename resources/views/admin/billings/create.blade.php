<x-admin.layout>
    <x-slot name="title">Quotation</x-slot>
    <x-slot name="pageHeading">Create Quotation</x-slot>
    <div class="card card-radius-20">
        <div class="card-body">
            <form id="quotation" method="POST" action="{{ route('billings.store') }}">
                @csrf
                <div class="form-row">
                    <h5>Customer details:</h5>
                </div>
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <button type="button" id="cc-btn" class="btn btn-outline-warning">New Customer</button>
                            @if (isset($customers) && count($customers))
                                <button type="button" id="sc-btn" class="btn btn-outline-warning">Choose Customer</button>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-3" id="select-cus-btn" style="display:none;">
                                <select class="form-control" id="category" name="customer_id">
                                    <option value="">-Select Customer-</option>
                                    @if (isset($customers) && count($customers))
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-12" id="create-cus-btn" style="display:none;">
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="text" name="name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="address" class="form-control" placeholder="Address">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="contact_no" class="form-control" placeholder="Contact No">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <h5>Quotation details:</h5>
                </div>
                <div class="form-row">
                    <div class="col-2">
                        <select class="form-control" id="category" name="category[]">
                        <option value="">-Select Category-</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-1">
                        <input type="text" name="width[]" class="form-control" placeholder="Width">
                    </div>
                    <div class="col-1">
                        <input type="text" name="height[]" class="form-control" placeholder="Height">
                    </div>
                    <div class="col-1">
                        <input type="text" name="shutter[]" class="form-control" placeholder="Shutter">
                    </div>
                    <div class="col-1">
                        <input type="text" name="net[]" class="form-control" placeholder="Net">
                    </div>
                    <div class="col-2">
                        <input type="text" name="sq_feet[]" class="form-control" placeholder="Sq. Feet">
                    </div>
                    <div class="col-2">
                        <input type="text" name="rate[]" class="form-control" placeholder="Rate">
                    </div>
                    <div class="col-2 m-0 p-2">
                        <i class="fas fa-plus-circle add pointer"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2" id="create-quotation">Create </button>
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
                submitBtn: '#create-quotation',
                rowCount: 1,
                btn: '.btn',
                ccBtn: '#cc-btn',
                scBtn: '#sc-btn',
                createCusBtn: '#create-cus-btn',
                selectCusBtn: '#select-cus-btn',
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
                $('<div class="mt-2" id="'+itemId+'"><div class="form-row"><div class="col-2"> <select class="form-control" id="category" name="category[]"><option value="">-Select Category-</option> @foreach ($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option> @endforeach </select></div><div class="col-1"> <input type="text" name="width[]" class="form-control" placeholder="Width"></div><div class="col-1"> <input type="text" name="height[]" class="form-control" placeholder="Height"></div><div class="col-1"> <input type="text" name="shutter[]" class="form-control" placeholder="Shutter"></div><div class="col-1"> <input type="text" name="net[]" class="form-control" placeholder="Net"></div><div class="col-2"> <input type="text" name="sq_feet[]" class="form-control" placeholder="Sq. Feet"></div><div class="col-2"> <input type="text" name="rate[]" class="form-control" placeholder="Rate"></div><div class="col-2 m-0 p-2"> <i class="fas fa-minus-circle pointer" id="_'+itemId+'"></i></div></div></div>').insertBefore($(DOM.submitBtn));
                document.querySelector('#_'+itemId).addEventListener('click', () => {
                    ctrlDeleteItem(itemId);
                }, false);
            };

            var ctrlDeleteItem = (removeItemId) => {
                console.log(removeItemId)
                $('#'+removeItemId).remove();
                DOM.rowCount--;
            }

            var addActiveClass = (id) => {
                $(id).addClass('active');
            }

            var toggleCreateSelect = (e, action) => {
                $(DOM.btn).removeClass('active');
                if(action == 'create'){
                    $(DOM.createCusBtn).toggle();
                    $(DOM.selectCusBtn).hide();
                    addActiveClass('#'+e.target.id);
                }else if(action == 'select'){
                    $(DOM.selectCusBtn).toggle();
                    $(DOM.createCusBtn).hide();
                    addActiveClass('#'+e.target.id);
                }else {
                    console.log(`${action} has changed!`);
                }
            }

            var toggleCreateSelectCustomer = () => {
                $(DOM.ccBtn).click((e)=>{
                    toggleCreateSelect(e, 'create');
                });

                $(DOM.scBtn).click((e)=>{
                    toggleCreateSelect(e, 'select');
                });
            }

            return {
                init: function() {
                    console.log('Application has started.');
                    setupEventListeners();
                    toggleCreateSelectCustomer();
                }
            };
            })(uiController);
            controller.init();
        });
    </script>
    @endpush
</x-admin.layout>
