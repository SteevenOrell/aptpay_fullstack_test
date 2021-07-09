@extends("Layouts.app")
@section("body")
<h3 id="list-title"> Disbursement List </h3>
<a href="{{ route('create') }}"> <button type="button" class="btn btn-light" >Add disbursement </button> </a> 
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Amount</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
      @foreach($alldata as $data)
    
 <tr>
      <th scope="row">{{ json_decode((string)$data,true)['id']}}</th>
      <td>{{ json_decode((string)$data,true)['amount']}} ({{ json_decode((string)$data,true)['currency']  }})</td>
      <td>{{ json_decode((string)$data,true)['date'] }}</td>
      <td>{{ json_decode((string)$data,true)['status'] }}</td>
    </tr>

      @endforeach
    
  </tbody>
</table>






@endsection