@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- Content Row -->
    <div class="card">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">
                المنتجات
            </h6>
            <div class="ml-auto">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">منتج جديد</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-product" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">الباركود</th>
                            <th class="text-center">الإسم</th>
                            <th class="text-center">السعر</th>
                            <th class="text-center">الصنف</th>
                            <th class="text-center">الكمية</th>
                            <!-- <th class="text-center">الصورة</th> -->
                            <th class="text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->code, 'C39',1,33,array(1,1,1), true) }}" alt="{{ $product->code }}" width="100" height="40">
                            </td>
                            <td class="text-center">{{ $product->name }}</td>
                            <td class="text-center">{{ $product->price }}</td>
                            <td class="text-center"><span class="badge badge-info">{{ $product->category ? $product->category->name : '---' }}</span></td>
                            <td class="text-center">{{ $product->quantity }}</td>
                            <!-- <td class="text-center"> -->
                                @if($product->image)
                                    <a href="{{ asset('storage/'.$product->image->id.'/'.$product->image->file_name) }}" target="_blank">
                                        <img src="{{ asset('storage/'.$product->image->id.'/'.$product->image->file_name) }}" width="45px" height="45px" />
                                    </a>
                                @else
                                    <!-- <span class="badge badge-warning">no image</span> -->
                                @endif
                            <!-- </td> -->
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <form onclick="return confirm('هل انت متأكد؟')" class="d-inline" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">لا توجد بيانات</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Content Row -->

</div>
@endsection

@push('script-alt')
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    let deleteButtonTrans = 'delete selected'
    let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.mass_destroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('zero selected')
        return
      }
      if (confirm('هل انت متأكد؟')) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  $('.datatable-product:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush
