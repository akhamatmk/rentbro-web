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
                   <ul class="list-group">
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