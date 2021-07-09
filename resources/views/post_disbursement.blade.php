@extends("Layouts.app")
@section("body")

@if($errors->any())
  <div id="div-alert">
    <div class="alert alert-danger" role="alert">
      @foreach($errors->all() as $error)
       <li>
        {{$error}}
       </li>
     @endforeach
    </div>
  </div>
@endif
@if(count($paramsErrors) > 0 )
<div id="div-alert">
    <div class="alert alert-danger" role="alert">
      @foreach($paramsErrors as $err)
       <li>
        {{$err}}
       </li>
     @endforeach
    </div>
  </div>
@endif
 <form method="POST" >
  <h4  class="form-text text-muted">Make Disbursement</h4>
 
      @csrf
      <div class="form-row">
      @foreach($formNames as $key => $name)
      @if($name == 'amount')
      <div class="col-auto my-1">
           <label for="examplefor{{$name}}">{{$key}}*</label>
           <input type="number" step="0.0001" min="0.1" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{$key}}"  autocomplete="off">
        </div>
       @elseif($name == 'currency')
    <div class="col-auto my-1">
    <label class="mr-sm-1" for="inlineFormCustomSelect">{{$key}}*</label>
      <select class="custom-select mr-sm-1" id="{{ $name }}" name="{{ $name }}">
        <option value="{{null}}" >Choose Currency...</option>
        @foreach($currencyArr as $itemArr)
        <option value="{{ $itemArr }}" > {{ $itemArr}}  </option>
        @endforeach
      </select>
    </div>
    @elseif($name == 'transactionType')
    <div class="form-group">
    <label class="mr-sm-1" for="inlineFormCustomSelect">{{$key}}*</label>
      <select class="custom-select mr-sm-1" id="{{ $name }}" name="{{ $name }}">
        <option value="{{null}}">Choose transaction type...</option>
        <option value="CARD"> CARD  </option>
        <option value="EFT"> EFT  </option>
      </select>
    </div>
    @elseif($name == 'paymentType')
    <div class="form-group">
    <label class="mr-sm-1" for="inlineFormCustomSelect">{{$key}}*</label>
      <select class="custom-select mr-sm-1" id="{{ $name }}" name="{{ $name }}">
        <option value="{{null}}">Choose payment type...</option>
        <option value="BDB"> Business Disbursements </option>
        <option value="GDB"> Government Disbursements  </option>
        <option value="CBP"> Credit Card Billpayment  </option>
      </select>
    </div>
    @elseif($name == 'mode')
    <div class="form-group">
    <label class="mr-sm-1" for="inlineFormCustomSelect">{{$key}}</label>
      <select class="custom-select mr-sm-1" id="{{ $name }}" name="{{ $name }}">
        <option value="0" selected> standard </option>
        <option value="1"> self-serve  </option>
      </select>
    </div>
    @elseif($name == 'network')
    <div class="col-auto my-1">
    <label class="mr-sm-1" for="inlineFormCustomSelect">{{$key}}</label>
      <select class="custom-select mr-sm-1" id="{{ $name }}" name="{{ $name }}">
      <option value="{{null}}" selected> Choose card type ... </option>
        <option value="MASTERCARD"> MASTERCARD </option>
        <option value="VISA" selected> VISA  </option>
      </select>
    </div>
    @elseif($name == 'payeeId')
    <div class="col-auto my-1">
    <label for="examplefor{{ $name}}">{{$key}}*</label>
    <input type="text" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{$key}}" autocomplete="off">
  </div>
    @else
      <div class="col-auto my-1">
        <label for="examplefor{{ $name}}">{{$key}}</label>
         <input type="text" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{$key}}" autocomplete="off">
     </div>
      @endif
   @endforeach
</div>
<div id="btn-submit"> <input class="btn btn-dark"  type=submit value="Submit"></div>
     

</form>





@endsection

