@foreach($results as $result)
<div class="pmanager-box col-md-2 col-4"><img class="pmanager-img pmanagerUse" data-id="{{$result->id}}" src="{{$result->photo}}" alt="{{$result->id}}"/><br><span>{{Str::limit($result->name, 10)}}</span><div class="pmanagerShow" data-id="{{$result->id}}">view</div></div>
@endforeach