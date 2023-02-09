<!-- Modal -->
<div class="modal fade" id="category{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deletecategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form>
                @csrf
                {!! method_field('DELETE') !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="deletecategoryLabel">Delete category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <p class="mb-3">
                            Do you want to delete this category ?
                        </p>
                    </div>
                </div>
                <div class="modal-footer custom">
                    <div class="left-side">
                        <button type="button" class="btn btn-link danger" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <button type="button" class="btn btn-link success delete" data-targer="#category{{ $category->id }}"
                                data-href="{{ route('category.delete', $category->id) }}">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /End Modal -->
