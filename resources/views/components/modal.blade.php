<div>
    <div class="modal fade" id="{{ isset($modalId) ? $modalId : '' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @if(isset($modalHeader) && $modalHeader )
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ isset($modalTitle) ? $modalTitle : ''}}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                @endif
                <div class="modal-body">{{ isset($modalBody) ? $modalBody : '' }}</div>
                @if(isset($modalFooter))
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    {{ isset($modalFooterBody) ? $modalFooterBody : '' }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
