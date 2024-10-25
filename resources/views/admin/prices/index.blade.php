@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-links"></span> اسعار اليوم
				</div>
				<div class="col-12 col-lg-4 p-0">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.prices.create')}}">
						<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
						</a>
					{{-- @permission('menu-links-create')
					<a href="{{route('admin.menu-links.create',['menu_id'=>request()->get('menu_id')])}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
					</a>
					@endpermission --}}
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET">
					<input type="text" name="q" class="form-control" placeholder="بحث ... " value="{{request()->get('q')}}">
				</form>
			</div>
		</div>
		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">
				
			
			<table class="table table-bordered  table-hover sortable-table">
				<thead>
					<tr>
						<th>#</th>
						<th>العنوان</th>
						<th>الوصف</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody id="sortable-table">
					@foreach($prices as $price)
					<tr>
						<td class="ui-state-default drag-handler" data-linkid="{{$price->id}}">{{$price->id}}</td>
						
						<td>{{$price->title}}</td>
						<td>{{$price->description}}</td>
						<td style="width: 270px;">

						 
							<a href="{{route('admin.prices.edit',$price)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							<form method="POST" action="{{route('admin.prices.destroy',$price)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> حذف
								</button>
							</form>
							{{-- @permission('menu-links-update')
							<a href="{{route('admin.prices.edit',$price)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							@endpermission

							@permission('menu-links-delete')
							<form method="POST" action="{{route('admin.menu-links.destroy',$link)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> حذف
								</button>
							</form>
							@endpermission --}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{$prices->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection