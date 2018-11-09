
<style type="text/css">
	.btn-compose-email {
    padding: 10px 0px;
}

.btn-danger {
    background-color: #E9573F;
    border-color: #E9573F;
    color: white;
}

.panel-teal .panel-heading {
    background-color: #37BC9B;
    border: 1px solid #36b898;
    color: white;
}

.panel .panel-heading {
    padding: 5px;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
    border-radius: 0px;
}

.panel .panel-heading .panel-title {
    padding: 10px;
    font-size: 17px;
}
</style>
<!-- resumt -->
<div class="panel panel-default">
    <div class="panel-heading resume-heading">
       <div class="row">
          <div class="col-lg-12">                       
             <div class="col-xs-12 col-sm-12">
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Edit Profile
               </button>
               <ul class="list-group" style="margin-top: 20px">
                  <li class="list-group-item"><b>Nickname</b> : {{ $vendor->nickname }}</li>
                  <li class="list-group-item"><b>Fullname</b> : {{ $vendor->full_name }}</li>
                  <li class="list-group-item"><b>Motto</b> : {{ $vendor->motto }}</li>
               </ul>
             </div>
          </div>
       </div>
    </div>
    <div class="bs-callout bs-callout-danger mt-10">
      <h4>Deskripsi</h4>
      {{ $vendor->description }}
   </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <form action="{{ url('vendor/'.$vendor->nickname.'/edit/profile') }}" method="POST" >
   <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          @csrf
           <div class="form-group">
             <p style="margin: 0">Fullname</p>
             <input type="text" name="full_name" class="form-control" id="full_name" value="{{ $vendor->full_name }}">
           </div>
           <div class="form-group">
             <p style="margin: 0">Motto</p>
             <textarea class="form-control" id="motto" name="motto">{{ $vendor->motto }}</textarea>
           </div>

           <div class="form-group">
             <p style="margin: 0">Deskripsi Toko</p>
             <textarea class="form-control" id="description" name="description">{{ $vendor->description }}</textarea>
           </div>

         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
  </form>
</div>        