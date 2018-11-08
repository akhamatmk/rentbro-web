<style type="text/css">
   label {
      color:black;
      text-align: left;
   }

   #pac-input{
      margin-left: 30px;
   }
</style>
<form action="{{ url('location/'.$vendor->nickname.'/vendor/edit') }}" method="POST" >
   @csrf
  <div class="form-group row">
    <label for="province" class="col-sm-2 col-form-label">Provinsi</label>
    <div class="col-sm-6">
      <select id="province" name="province" class="form-control">
         <option value="">-Silahkan Pilih-</option>
         @foreach($province as $key => $value)
            @php $select=''  @endphp
            @if($location->regency->province_id == $value->id)
               @php $select='selected="selected"' @endphp
            @endIf
            <option {{ $select }} value="{{ $value->id }}">{{$value->name}}</option>
         @endForeach
      </select>
    </div>
   </div>
  
   <div class="form-group row">
      <label for="regency" class="col-sm-2 col-form-label">Kabupaten / Kota</label>
      <div class="col-sm-6">
         <input type="hidden" name="id" value="{{ $location->id }}">
         <select id="regency" name="regency" class="form-control">
            @foreach($regency as $key => $value)
               @php $select=''  @endphp
               @if($location->regency->id == $value->id)
                  @php $select='selected="selected"' @endphp
               @endIf
               <option {{ $select }} value="{{ $value->id }}">{{$value->name}}</option>
            @endForeach
         </select>
      </div>
   </div>

   <div class="form-group row">
      <label for="district" class="col-sm-2 col-form-label">Kecamatan</label>
      <div class="col-sm-6">
         <select id="district" name="district" class="form-control">
             @foreach($district as $key => $value)
               @php $select=''  @endphp
               @if($location->district_id == $value->id)
                  @php $select='selected="selected"' @endphp
               @endIf
               <option {{ $select }} value="{{ $value->id }}">{{$value->name}}</option>
            @endForeach
         </select>
      </div>
   </div>

   <div class="form-group row">
      <label for="district" class="col-sm-2 col-form-label">Detail Warehouse</label>
      <div class="col-sm-6">
         <textarea class="form-control" name="location_detail" id="location_detail">{{ $location->detail_location }}</textarea>
      </div>
   </div>

   <div class="form-group row">
      <label for="district" class="col-sm-2 col-form-label">Pilih Lokasi Di map</label>
      <div class="col-sm-8">
         <input name="map_street" id="map_street" type="text" class="input_field form-control" readonly="readonly" required="required" style="margin-bottom: 10px" value="{{ $location->map_street }}">
         <input type="hidden" name="lat" id="lat">
         <input type="hidden" name="long" id="long">
         @include('user/vendor/maps')
      </div>
   </div>

   <div class="form-group row">
      <button style="margin: 20px" type="submit" class="btn btn-primary">Simpan</button>
   </div>
</form>

<script type="text/javascript">   
ready(function(){
   $("#province").change(function(){
         $.ajax({
            type: "GET",
            url: '{{ URL::to("place/regency") }}',
            data : {
               "province_id": $(this).val(),
            },
            dataType: 'json',
            success: function(data){
               $("#regency").html("");
               $("#district").html("");
               $.each( data.data, function( key, value ) {
                  if(value.type == 1)
                     var kind = "Kabupaten";
                  else
                     var kind = "Kota";

                  $("#regency").append("<option value='"+value.id+"'> "+kind+" "+value.name+"</option>");
               });
            }
         });
      });

      $("#regency").change(function(){
         $.ajax({
            type: "GET",
            url: '{{ URL::to("place/district") }}',
            data : {
               "regency_id": $(this).val(),
            },
            dataType: 'json',
            success: function(data){
               $("#district").html("");
               $.each( data.data, function( key, value ) {

                  $("#district").append("<option value='"+value.id+"'>"+value.name+"</option>");
               });
            }
         });
      });
});
</script>