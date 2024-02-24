<div class="card-body accordion" id="default-accordion">
    <div class="card-header mb-2">
        <div class="d-flex">
            <div class="d-flex flex-grow-1 align-items-center">
                <h4 class="card-title mb-0 me-3">Checklists</h4>
                <div class="progress h-50" style="width: 75px;">
                    @php
                        $i= 0;
                        $total = count($action_items);
                        $checkedItems = count($action_items->where('is_checked', 1));
                    @endphp
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $total>0 && $checkedItems>0 ? (100 * $checkedItems) / $total : 0 }}%;" aria-valuemin="{{ $checkedItems }}" aria-valuemax="{{ $total }}" aria-valuemax="100">{{ $checkedItems }}/{{ $total }}</div>
                </div>
            </div>
            <div class="d-flex justify-content-end flex-grow-0">
                <a href="javascript:void(0);" class="btn btn-sm bg-transparent fs-16 py-0"><i class="bx bx-expand-alt"></i></a>
                <a href="javascript:void(0);" onclick="task.createActionItems()" class="btn btn-sm bg-transparent fs-16 py-0"><i class="bx bx-plus"></i></a>
            </div>
        </div><!-- end card header -->
    </div>

    @foreach ($action_items->groupBy('id') as $items)
    <div class="mb-3 accordion-item">
        <ul class="list-group">
            <li class="list-group-item bg-light-subtle" aria-current="true" id="heading{{ $items[0]->id }}">
               <div class="input-group collapsed" type="button" data-bs-toggle="collapse"0-
                    data-bs-target="#collapse{{ $items[0]->id }}" aria-expanded="false" aria-controls="collapse{{ $items[0]->id }}">
                <input type="text" class="form-control wb-task-title-fld-sm me-1 bg-light-subtle" onblur="task.changeActionName(this, {{ $items[0]->id }})" value="{{ $items[0]->action_name }}" style="max-width: 20%">
                <span class="fs-12 me-2"> ({{ count($items->where('is_checked', 1)) }}/{{ count($items) }})</span>
                <div class="dropdown card-header-dropdown">
                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="text-muted fs-18"><i class="ri-settings-4-line align-middle me-1 fs-18"></i></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.deleteActionHandler({{ $items[0]->id }})"><i class="ri-delete-bin-6-line text-danger me-2 align-bottom"></i>Delete</a>
                        </li>
                     </ul>
                </div>
               </div>
            </li>
            <div id="collapse{{ $items[0]->id }}" class="accordion-collapse collapse {{ !$i++ ? 'show' : '' }}" aria-labelledby="heading{{ $items[0]->id }}"
                 data-bs-parent="#default-accordion">
                <div class="accordion-body p-0">
                @foreach ($items as $item)
                <li class="list-group-item d-flex">
                    <div class="d-flex flex-grow-1 align-items-center">
                        <div class="form-check me-3">
                            <input class="form-check-input rounded-circle" onchange="task.changeCheckStatusHandler(this, {{ $item->id }}, {{ $item->item_id }})" type="checkbox" id="formCheck6" {{ $item->is_checked ? 'checked' : '' }}>
                            <label class="form-check-label" for="formCheck6">
                                {{ $item->item_name }}
                            </label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-0">
                        <a href="javascript:void(0);" class="btn btn-sm bg-transparent text-info fs-16 py-0" onclick="task.editActionItem(this, {{ $item->id }}, {{ $item->item_id }}, '{{ $item->item_name }}')"><i class="bx bx-edit"></i></a>
                        <a href="javascript:void(0);" class="btn btn-sm bg-transparent text-danger fs-16 py-0" onclick="task.removeActionItems({{ $item->id }}, {{ $item->item_id }})"><i class="bx bx-trash"></i></a>
                    </div>
                </li>
            @endforeach
                </div>
            </div>

            <li class="list-group-item" id="insert_btn_section_{{ $items[0]->id }}">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <a href="javascript:void(0);" onclick="task.insertActionItemForm({{ $items[0]->id }})" class="btn btn-sm bg-transparent text-muted fs-14 p-0"><i class="bx bx-plus"></i> New checklist item</a>
                    </div>
                </div>
            </li>
            <li class="list-group-item d-none" id="insert_form_{{ $items[0]->id }}">
                <div class="d-flex flex-grow-1 align-items-center">
                    <div class="form-group">
                       <input type="text" class="form-control form-control-sm" id="item_name_{{ $items[0]->id }}">
                    </div>
                </div>
                <div class="d-flex justify-content-end flex-grow-0">
                    <a href="javascript:void(0);" class="btn btn-sm bg-transparent text-primary fs-16 py-0" onclick="task.insertActionItemHandler({{ $items[0]->id }})"><i class="bx bx-save"></i></a>
                    <a href="javascript:void(0);" class="btn btn-sm bg-transparent text-danger fs-16 py-0" onclick="task.hideActionItemInsertForm({{ $items[0]->id }})"><i class="bx bx-trash"></i></a>
                </div>
            </li>
        </ul>
    </div>
    @endforeach
</div>
